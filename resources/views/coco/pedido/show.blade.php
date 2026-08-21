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
                            <a class="btn btn-primary btn-sm" href="{{ route('coco-pedidos.index') }}"> {{ __('Back') }}</a>
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
                            <strong>Total:</strong>
                            {{ $pedido->total }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Fecha y Hora de Entrega:</strong>
                            {{ $pedido->fecha_hora_entrega }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Lugar:</strong>
                            {{ $pedido->lugar_id }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Entrega:</strong>
                            {{ ucfirst($pedido->entrega ?? 'pendiente') }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Información Adicional:</strong>
                            {{ $pedido->informacion_adicional }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
