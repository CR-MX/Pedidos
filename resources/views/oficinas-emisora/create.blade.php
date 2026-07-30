@extends('adminlte::page')

@section('title', 'Agregar Oficina Emisora')

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header color-header">
                        <span class="card-title">Agregar Oficina Emisora</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('oficinas-emisoras.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('oficinas-emisora.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
