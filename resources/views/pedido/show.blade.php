@extends('adminlte::page')

@section('template_title')
    {{ $pedido->name ?? __('Show') . " " . __('Pedido') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Pedido</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('pedidos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre:</strong>
                                    {{ $pedido->nombre }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Red Social:</strong>
                                    {{ $pedido->red_social }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Anticipo:</strong>
                                    {{ $pedido->anticipo }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha Hora Entrega:</strong>
                                    {{ $pedido->fecha_hora_entrega }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Lugar Id:</strong>
                                    {{ $pedido->lugar_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Informacion Adicional:</strong>
                                    {{ $pedido->informacion_adicional }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
