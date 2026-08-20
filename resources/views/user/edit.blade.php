@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content')
<br>
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header color-header">
                    <span class="card-title">Editar Usuario</span>
                </div>
                <div class="card-body bg-white">
                    <form method="POST" action="{{ route('user.update', $user->id) }}" role="form">
                        @csrf
                        @method('PUT')

                        @include('user.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection