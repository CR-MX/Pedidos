@extends('adminlte::page')

@section('template_title')
    {{ __('Create') }} Lugare
@endsection

@section('content')
    <br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header color-header">
                        <span class="card-title">Agregar Lugar</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('lugares.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('lugare.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
