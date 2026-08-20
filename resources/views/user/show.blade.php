@extends('adminlte::page')

@section('title', 'Mostrar Usuario')

@section('content')
<br>
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header color-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="float-left">
                        <span class="card-title">Mostrar Usuario</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('user.index') }}"> Volver</a>
                    </div>
                </div>

                <div class="card-body bg-white">
                    <div class="form-group mb-2">
                        <strong>Nombre:</strong>
                        {{ $user->name }}
                    </div>
                    <div class="form-group mb-2">
                        <strong>Correo:</strong>
                        {{ $user->email }}
                    </div>
                    <div class="form-group mb-2">
                        <strong>Roles:</strong>
                        @forelse ($user->roles as $role)
                            <span class="badge badge-primary">{{ $role->name }}</span>
                        @empty
                            <span class="text-muted">Sin rol</span>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection