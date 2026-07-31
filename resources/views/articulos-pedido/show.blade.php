@extends('adminlte::page')

@section('template_title')
    {{ $articulosPedido->name ?? __('Show') . " " . __('Articulos Pedido') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Articulos Pedido</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('articulos-pedidos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>ID Pedido:</strong>
                                    {{ $articulosPedido->pedido_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre:</strong>
                                    {{ $articulosPedido->nombre }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Color:</strong>
                                    {{ $articulosPedido->color }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Cantidad:</strong>
                                    {{ $articulosPedido->cantidad }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>ID Tipo:</strong>
                                    {{ $articulosPedido->tipo_id }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
