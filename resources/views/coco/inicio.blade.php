@extends('adminlte::page')

@section('title', 'Inicio')

@section('content')
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header color-header">Inicio</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-6 position-relative">
                            <button type="button" class="btn btn-sm"
                                style="position:absolute; top:5px; right:5px; z-index:10;"
                                onclick="toggleBox('ventas')">
                                <i class="fas fa-eye" style="color: white"  id="icono-ventas"></i>
                            </button>
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3 id="oculto-ventas">*****</h3>
                                    <h3 id="real-ventas" style="display:none">${{ number_format($ventasUltimoMes, 2) }}</h3>
                                    <p>Ventas del último mes</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $pedidosUltimoMes }}</h3>
                                    <p>Pedidos del último mes</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-box"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6 position-relative">
                            <button type="button" class="btn btn-sm "
                                style="position:absolute; top:5px; right:5px; z-index:10;"
                                onclick="toggleBox('cobrar')">
                                <i class="fas fa-eye"  id="icono-cobrar"></i>
                            </button>
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3 id="oculto-cobrar">*****</h3>
                                    <h3 id="real-cobrar" style="display:none">${{ number_format($porCobrarPendiente, 2) }}</h3>
                                    <p>Por cobrar</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-money-bill"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ $pendientesEntrega }}</h3>
                                    <p>Pedidos pendientes</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-truck"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">Pedidos de los últimos 15 días</div>
                                <div class="card-body">
                                    <canvas id="graficaPedidos" style="height:220px; width:100%;"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">Ventas de los últimos 15 días</div>
                                <div class="card-body">
                                    <canvas id="graficaVentas" style="height:220px; width:100%;"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">Entregas de los próximos 14 días</div>
                                <div class="card-body">
                                    <canvas id="graficaEntregas" style="height:220px; width:100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-header">Ventas por lugar (último mes)</div>
                        <div class="card-body p-0">
                            <table class="table table-sm table-striped table-bordered mb-0">
                                <thead>
                                    <tr class="table-primary">
                                        <th>Lugar</th>
                                        <th>Ventas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($ventasPorLugar as $venta)
                                        <tr>
                                            <td>{{ $venta->lugar }}</td>
                                            <td>${{ number_format($venta->total, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center">Sin ventas registradas</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        function toggleBox(id) {
            var oculto = document.getElementById('oculto-' + id);
            var real   = document.getElementById('real-' + id);
            var icon   = document.getElementById('icono-' + id);
            if (oculto.style.display === 'none') {
                oculto.style.display = '';
                real.style.display = 'none';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            } else {
                oculto.style.display = 'none';
                real.style.display = '';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            }
        }

        var opcionesGrafica = {
            responsive: true,
            maintainAspectRatio: false,
            legend: { display: false },
            tooltips: { mode: 'index', intersect: false },
            scales: {
                xAxes: [{ gridLines: { display: false } }],
                yAxes: [{ ticks: { beginAtZero: true } }]
            }
        };

        new Chart(document.getElementById('graficaPedidos').getContext('2d'), {
            type: 'line',
            data: {
                labels: {!! json_encode($diasPedidos) !!},
                datasets: [{
                    label: 'Pedidos',
                    data: {!! json_encode($pedidosDiarios) !!},
                    borderColor: '#28a745',
                    backgroundColor: 'rgba(40,167,69,0.1)',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: opcionesGrafica
        });

        new Chart(document.getElementById('graficaVentas').getContext('2d'), {
            type: 'line',
            data: {
                labels: {!! json_encode($diasVentas) !!},
                datasets: [{
                    label: 'Ventas',
                    data: {!! json_encode($ventasDiarias) !!},
                    borderColor: '#17a2b8',
                    backgroundColor: 'rgba(23,162,184,0.1)',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: opcionesGrafica
        });

        new Chart(document.getElementById('graficaEntregas').getContext('2d'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($diasEntregas) !!},
                datasets: [{
                    label: 'Entregas',
                    data: {!! json_encode($entregasDiarias) !!},
                    backgroundColor: '#dc3545'
                }]
            },
            options: opcionesGrafica
        });
    </script>
@endsection
