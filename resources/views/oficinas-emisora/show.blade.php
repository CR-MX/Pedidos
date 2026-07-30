@extends('adminlte::page')

@section('title', 'Oficina Emisora')

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header color-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">Oficina Emisora</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('oficinas-emisoras.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre:</strong>
                                    {{ $oficinasEmisora->nombre }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
