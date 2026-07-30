<div class="text-dark">
    <style>
        .texto-limitado {
            max-width: 120px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .texto-limitado:hover {
            white-space: normal;
            word-wrap: break-word;
        }
    </style>
    <div class="d-flex flex-row flex-wrap">
        <div class="p-2">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="folio input-group-text" tabindex="-1">
                        Mostrar:
                    </span>
                </div>
                <select wire:model.live="perPage" class="form-control">
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                </select>
            </div>
        </div>
        <div class="p-2">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="folio input-group-text" tabindex="-1">
                        Orden por:
                    </span>
                </div>
                <select wire:model.live="orderBy" class="form-control">
                    <option value="nombre">Nombre</option>
                    <option value="anticipo">Anticipo</option>
                    <option value="dias_restantes">Días Restantes</option>
                    <option value="fecha_hora_entrega">Fecha Entrega</option>
                </select>
            </div>
        </div>
        <div class="p-2">
            <div class="btn-group" role="group" aria-label="Orden" style="height: 46px">
                <input type="radio" wire:model.live="orderAsc" class="btn-check" name="order" id="desc"
                    value="1">
                <label class="btn btn-outline-secondary color btn-center" for="desc">
                    <i class="fas fa-arrow-up"></i>
                </label>
                <input type="radio" wire:model.live="orderAsc" class="btn-check" name="order" id="asc"
                    value="0">
                <label class="btn btn-outline-secondary color btn-center" for="asc">
                    <i class="fas fa-arrow-down"></i>
                </label>
            </div>
        </div>
        <div class="p-2">
            <button class="btn btn-outline-info btn-render" wire:click="$refresh" id="render" style="height: 38px"><i
                    class="fas fa-sync"></i></button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-sm table-striped table-hover no-footer" role="grid">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nombre</th>
                    <th>Red Social</th>
                    <th>Anticipo</th>
                    <th>Por Cobrar</th>
                    <th>Días Rest.</th>
                    <th>Fecha Entrega</th>
                    <th>Lugar</th>
                    <th>Acciones</th>
                </tr>
                <tr>
                    <th></th>
                    <th><input wire:model.live.debounce.250ms="search_nombre" type="text"
                            class="form-control" placeholder="Buscar..."></th>
                    <th><input wire:model.live.debounce.250ms="search_red_social" type="text" class="form-control"
                            placeholder="Buscar..."></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($registros as $pedido)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td class="texto-limitado">{{ $pedido->nombre ?? '' }}</td>
                        <td>{{ $pedido->red_social ?? '' }}</td>
                        <td>${{ number_format($pedido->anticipo ?? 0, 2) }}</td>
                        <td>${{ number_format($pedido->por_cobrar ?? 0, 2) }}</td>
                        <td>
                            @php
                                $dias = $pedido->dias_restantes ?? 999;
                            @endphp
                            @if ($dias >= 6)
                                <span class="badge bg-success" style="font-size:1rem; padding:8px 12px;">{{ $dias }} días</span>
                            @elseif ($dias >= 3)
                                <span class="badge bg-warning text-dark" style="font-size:1rem; padding:8px 12px;">{{ $dias }} días</span>
                            @else
                                <span class="badge bg-danger" style="font-size:1rem; padding:8px 12px;">{{ $dias }} días</span>
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($pedido->fecha_hora_entrega)->format('d/m/Y h:i A') }}</td>
                        <td>{{ $pedido->lugar_nombre ?? '' }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-info" title="Ver artículos"
                                wire:click="verArticulos({{ $pedido->id }})">
                                <i class="fas fa-box"></i>
                            </button>
                            <form action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST">
                                <a class="btn btn-sm btn-success" title="Actualizar"
                                    href="{{ route('pedidos.edit', $pedido->id) }}"><i
                                        class="fa fa-fw fa-edit"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-eliminar" title="Eliminar"><i
                                        class="fa fa-fw fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {!! $registros->withQueryString()->links() !!}

    @if ($selectedPedidoId)
        <div class="modal" style="display:block; background:rgba(0,0,0,0.5); position:fixed; top:0; left:0; width:100%; height:100%; z-index:9999;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Artículos del Pedido</h5>
                        <button type="button" class="close" wire:click="cerrarModal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Color</th>
                                    <th>Cantidad</th>
                                    <th>Tipo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($articulos as $art)
                                    <tr>
                                        <td>{{ $art->nombre }}</td>
                                        <td>{{ $art->color }}</td>
                                        <td>{{ $art->cantidad }}</td>
                                        <td>{{ $art->tipo_nombre }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-center">Sin artículos</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>