@extends('adminlte::page')

@section('title', 'Sistema de Gestión de Pedidos')

@section('content')
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header color-header">Sistema de Gestión de Pedidos</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

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
                                    <p>Por cobrar pendiente</p>
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
                                    <p>Pedidos pendientes de entrega</p>
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
            legend: {
                display: false
            },
            scales: {
                xAxes: [
                    {
                        ticks: {
                            autoSkip: true,
                            maxTicksLimit: 15,
                            maxRotation: 0,
                            fontColor: '#333',
                            fontSize: 10
                        }
                    }
                ],
                yAxes: [
                    {
                        type: 'linear',
                        position: 'left',
                        scaleLabel: { display: true, labelString: 'Pedidos', fontSize: 11 },
                        ticks: { beginAtZero: true, stepSize: 5, fontColor: '#333', fontSize: 10 }
                    }
                ]
            }
        };

        new Chart(document.getElementById('graficaPedidos'), {
            type: 'line',
            data: {
                labels: @json($dias),
                datasets: [
                    {
                        label: 'Pedidos',
                        data: @json($pedidosPorDia),
                        borderColor: '#28a745',
                        backgroundColor: 'rgba(40,167,69,0.15)',
                        fill: true,
                        pointRadius: 2,
                        pointHoverRadius: 4
                    }
                ]
            },
            options: opcionesGrafica
        });

        var opcionesGraficaVentas = JSON.parse(JSON.stringify(opcionesGrafica));
        opcionesGraficaVentas.scales.yAxes[0].scaleLabel = { display: true, labelString: 'Ventas ($)', fontSize: 11 };
        opcionesGraficaVentas.scales.yAxes[0].ticks.stepSize = 500;

        new Chart(document.getElementById('graficaVentas'), {
            type: 'line',
            data: {
                labels: @json($dias),
                datasets: [
                    {
                        label: 'Ventas ($)',
                        data: @json($ventasPorDia),
                        borderColor: '#17a2b8',
                        backgroundColor: 'rgba(23,162,184,0.15)',
                        fill: true,
                        pointRadius: 2,
                        pointHoverRadius: 4
                    }
                ]
            },
            options: opcionesGraficaVentas
        });

        new Chart(document.getElementById('graficaEntregas'), {
            type: 'bar',
            data: {
                labels: @json($diasEntrega),
                datasets: [
                    {
                        label: 'Entregas',
                        data: @json($pedidosEntregaDia),
                        backgroundColor: '#58A187',
                        borderColor: '#24514F',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [
                        {
                            ticks: {
                                autoSkip: true,
                                maxTicksLimit: 14,
                                maxRotation: 0,
                                fontColor: '#333',
                                fontSize: 10
                            }
                        }
                    ],
                    yAxes: [
                        {
                            type: 'linear',
                            position: 'left',
                            scaleLabel: { display: true, labelString: 'Pedidos', fontSize: 11 },
                            ticks: { beginAtZero: true, stepSize: 1, fontColor: '#333', fontSize: 10 }
                        }
                    ]
                }
            }
        });
    </script>
@endsection
