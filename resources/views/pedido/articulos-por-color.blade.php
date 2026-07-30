@extends('adminlte::page')

@section('title', 'Artículos por Color')

@section('content')
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header color-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">Pedidos del día - {{ $fecha }}</span>
                            <form method="GET" action="{{ route('pedidos.articulos-por-color') }}" class="form-inline">
                                <label class="mr-2">Fecha:</label>
                                <input type="date" name="date" value="{{ $fechaInput }}"
                                    class="form-control form-control-sm" onchange="this.form.submit()">
                            </form>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        @forelse ($grupos as $color => $items)
                            <div class="card mb-3">
                                <div class="card-header py-2" style="background-color: #f0f0f0;">
                                    <strong>{{ $color }}</strong>
                                    <span class="badge bg-secondary float-right">{{ $items->sum('cantidad') }} pzas</span>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-sm table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th>Cant.</th>
                                                <th>Artículo</th>
                                                <th>Tipo</th>
                                                <th>Pedido</th>
                                                <th>Hora Entrega</th>
                                                <th>Lugar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($items as $art)
                                                <tr>
                                                    <td>{{ $art->cantidad }}</td>
                                                    <td>{{ $art->nombre }}</td>
                                                    <td>{{ $art->tipo?->nombre ?? '' }}</td>
                                                    <td>{{ $art->pedido?->nombre ?? '' }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($art->pedido?->fecha_hora_entrega)->format('h:i A') }}</td>
                                                    <td>{{ $art->pedido?->lugare?->nombre ?? '' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted text-center mb-0">Sin pedidos para hoy</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
