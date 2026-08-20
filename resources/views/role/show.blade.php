@extends('adminlte::page')

@section('title', 'Mostrar Rol')

@section('content')
<br>
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header color-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="float-left">
                        <span class="card-title">Mostrar Rol</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('roles.index') }}"> Volver</a>
                    </div>
                </div>

                <div class="card-body bg-white">
                    <div class="form-group mb-2">
                        <strong>Nombre:</strong>
                        {{ $role->name }}
                    </div>
                    <div class="form-group mb-2">
                        <strong>Permisos:</strong>
                        @forelse ($role->permissions as $permission)
                            <span class="badge badge-info">{{ $permission->name }}</span>
                        @empty
                            <span class="text-muted">Sin permisos</span>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection