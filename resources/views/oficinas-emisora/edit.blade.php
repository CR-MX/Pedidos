@extends('adminlte::page')

@section('title', 'Actualizar Oficina Emisora')

@section('content')
<br>
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header color-header">
                        <span class="card-title">Actualizar Oficina Emisora</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('oficinas-emisoras.update', $oficinasEmisora->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('oficinas-emisora.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
