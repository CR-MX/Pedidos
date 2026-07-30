@extends('adminlte::page')

@section('title', 'Agregar Credencial')


@section('content')
<br>

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header color-header">
                        <span class="card-title">Agregar Credencial</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('credenciales.store') }}" role="form"
                            enctype="multipart/form-data">
                            @csrf

                            @include('credenciale.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('adminlte_js')
    <script src="{{ asset('js/credenciale/form.js') }}"></script>
@endsection
