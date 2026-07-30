@extends('adminlte::page')

@section('title', 'Actualizar Credencial')


@section('content')
<br>

    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header color-header">
                        <span class="card-title">Actualizar Credencial</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('credenciales.update', $credenciale->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
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
    <script>
        var firmaExistente = '{{ $credenciale->firma ?? '' }}';
        var fotoExistente = '{{ $credenciale->foto ?? '' }}';
    </script>
    <script src="{{ asset('js/credenciale/form.js') }}"></script>
@endsection
