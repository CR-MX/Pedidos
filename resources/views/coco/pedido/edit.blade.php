@extends('adminlte::page')

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header color-header">
                        <span class="card-title">Actualizar Pedido</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('coco-pedidos.update', $pedido->id) }}" role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf
                            @include('coco.pedido.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
