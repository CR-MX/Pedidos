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

                    <div class="text-center py-5">
                        <h1 class="display-4">Bienvenido</h1>
                        <p class="lead">al Sistema de Gestión de Pedidos</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection