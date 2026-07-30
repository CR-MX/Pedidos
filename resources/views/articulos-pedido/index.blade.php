@extends('layouts.app')

@section('template_title')
    Articulos Pedidos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Articulos Pedidos') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('articulos-pedidos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
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
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
									<th >Pedido Id</th>
									<th >Nombre</th>
									<th >Color</th>
									<th >Cantidad</th>
									<th >Tipo Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($articulosPedidos as $articulosPedido)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $articulosPedido->pedido_id }}</td>
										<td >{{ $articulosPedido->nombre }}</td>
										<td >{{ $articulosPedido->color }}</td>
										<td >{{ $articulosPedido->cantidad }}</td>
										<td >{{ $articulosPedido->tipo_id }}</td>

                                            <td>
                                                <form action="{{ route('articulos-pedidos.destroy', $articulosPedido->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('articulos-pedidos.show', $articulosPedido->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('articulos-pedidos.edit', $articulosPedido->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $articulosPedidos->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
