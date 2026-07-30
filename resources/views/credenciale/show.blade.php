@extends('adminlte::page')

@section('title', 'Ver Credencial')


@section('content')
<br>

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Credenciale</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('credenciales.index') }}">
                                {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">

                        <div class="form-group mb-2 mb20">
                            <strong>Foto:</strong>
                            {{ $credenciale->foto }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Firma:</strong>
                            {{ $credenciale->firma }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Curp:</strong>
                            {{ $credenciale->curp }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Apellido Paterno:</strong>
                            {{ $credenciale->apellido_paterno }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Apellido Materno:</strong>
                            {{ $credenciale->apellido_materno }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Nombres:</strong>
                            {{ $credenciale->nombres }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Fecha Nacimiento:</strong>
                            {{ $credenciale->fecha_nacimiento }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Fecha Expedicion:</strong>
                            {{ $credenciale->fecha_expedicion }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Fecha Vencimiento:</strong>
                            {{ $credenciale->fecha_vencimiento }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Tipo Licencia:</strong>
                            {{ $credenciale->tipo_licencia }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Oficina Emisora:</strong>
                            {{ $credenciale->oficina_emisora }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Fecha Antiguedad:</strong>
                            {{ $credenciale->fecha_antiguedad }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Sexo:</strong>
                            {{ $credenciale->sexo }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Tipo Sangre:</strong>
                            {{ $credenciale->tipo_sangre }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Donador Organos:</strong>
                            {{ $credenciale->donador_organos }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Restricciones:</strong>
                            {{ $credenciale->restricciones }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>En Caso Accidente Nombre:</strong>
                            {{ $credenciale->en_caso_accidente_nombre }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>En Caso Accidente Numero:</strong>
                            {{ $credenciale->en_caso_accidente_numero }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
