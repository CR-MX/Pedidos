@extends('adminlte::page')

@section('template_title')
    {{ __('Update') }} Color
@endsection

@section('content')
    <br>
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header color-header">
                        <span class="card-title">Actualizar Color</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('colores.update', $color->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('color.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
