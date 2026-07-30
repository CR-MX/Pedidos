@extends('adminlte::page')

@section('title', 'Oficinas Emisoras')

@section('content')
<br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header color-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Oficinas Emisoras
                            </span>

                             <div class="float-right">
                                <a href="{{ route('oficinas-emisoras.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  Agregar
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <livewire:table-oficina-emisora />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
