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
                    <th>Fecha Entrega</th>
                    <th>Lugar</th>
                    <th>Entrega</th>
                    <th>Art.Imp</th>
                    <th>Por Cobrar</th>
                    <th>Acciones</th>
                </tr>
                <tr>
                    <th></th>
                    <th><input wire:model.live.debounce.250ms="search_nombre" type="text" class="form-control"
                            placeholder="Buscar..."></th>
                    <th><input wire:model.live="search_fecha_hora" type="date" class="form-control"></th>
                    <th>
                        <select wire:model.live="search_lugar" class="form-control">
                            <option value="">Lugar</option>
                            @foreach ($lugares as $lugar)
                                <option value="{{ $lugar->id }}">{{ $lugar->nombre }}</option>
                            @endforeach
                        </select>
                    </th>
                    <th>
                        <select wire:model.live="search_entrega" class="form-control">
                            <option value="">Entrega</option>
                            <option value="pendiente">Pendiente</option>
                            <option value="entregado">Entregado</option>
                        </select>
                    </th>
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
                        <td class="text-center">
                            @if ($pedido->fecha_hora_entrega)
                                {{ \Carbon\Carbon::parse($pedido->fecha_hora_entrega)->format('d/m/Y h:i A') }}
                                <br>
                                @php
                                    $dias = $pedido->dias_restantes ?? 999;
                                @endphp
                                @if ($dias >= 6)
                                    <span class="badge bg-success"
                                        style="font-size:0.9rem; padding:4px 8px;">{{ $dias }} días</span>
                                @elseif ($dias >= 3)
                                    <span class="badge bg-warning text-dark"
                                        style="font-size:0.9rem; padding:4px 8px;">{{ $dias }} días</span>
                                @else
                                    <span class="badge bg-danger"
                                        style="font-size:0.9rem; padding:4px 8px;">{{ $dias }} días</span>
                                @endif
                            @else
                                <span class="badge bg-secondary"
                                    style="font-size:0.9rem; padding:4px 8px;">Pendiente</span>
                            @endif
                        </td>
                        <td>
                            @if ($pedido->lugar_nombre)
                                {{ $pedido->lugar_nombre }}
                            @else
                                <span class="badge bg-secondary"
                                    style="font-size:0.9rem; padding:4px 8px;">Pendiente</span>
                            @endif
                        </td>
                        <td style="white-space: nowrap;">
                            @if (($pedido->entrega ?? 'pendiente') === 'entregado')
                                <span class="badge bg-success"
                                    style="font-size:1rem; padding:8px 12px;">Entregado</span>
                            @else
                                <button type="button" class="badge bg-warning text-dark border-0"
                                    title="Confirmar entrega" style="font-size:1rem; padding:8px 12px; cursor:pointer;"
                                    onclick="confirmarEntrega({{ $pedido->id }})">Pendiente</button>
                            @endif
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-info" title="Ver artículos"
                                wire:click="verArticulos({{ $pedido->id }})">
                                {{ $pedido->realizados_articulos }} / {{ $pedido->total_articulos }}
                                &nbsp; 
                                <i class="fas fa-box"></i>
                            </button>
                        </td>
                        <td>
                            @if ($pedido->por_cobrar > 0)
                                ${{ number_format($pedido->por_cobrar ?? 0, 2) }}
                            @else
                                <span class="badge bg-success" style="font-size:0.9rem; padding:4px 8px;">Pagado</span>
                            @endif
                        </td>
                        <td style="white-space: nowrap;">
                            @if (!empty($pedido->informacion_adicional))
                                <button type="button" class="btn btn-sm btn-primary" title="Información adicional"
                                    data-info="{{ $pedido->informacion_adicional }}" onclick="verInformacion(this)">
                                    <i class="fas  fa-comment-dots"></i>
                                </button>
                            @endif
                            <form action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST"
                                style="display: inline;">
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
        <div class="modal"
            style="display:block; background:rgba(0,0,0,0.5); position:fixed; top:0; left:0; width:100%; height:100%; z-index:9999;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Artículos del Pedido - {{ $selectedPedidoNombre }}</h5>
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
                                    <th>Realizado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($articulos as $art)
                                    <tr>
                                        <td>{{ $art->nombre }}</td>
                                        <td>{{ $art->color }}</td>
                                        <td>{{ $art->cantidad }}</td>
                                        <td>{{ $art->tipo_nombre }}</td>
                                        <td class="text-center">
                                            @if ($art->realizado)
                                                <span class="badge bg-success">Sí</span>
                                            @else
                                                <span class="badge bg-secondary">No</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Sin artículos</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script>
        function verInformacion(btn) {
            Swal.fire({
                html: '<p style="font-size:1.3rem; margin:0;">' + btn.dataset.info + '</p>',
                confirmButtonText: 'Aceptar'
            });
        }

        function confirmarEntrega(id) {
            Swal.fire({
                title: '¿Confirmar entrega?',
                text: 'Marcar este pedido como entregado',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, entregado',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('confirmarEntrega', id);
                }
            });
        }

        Livewire.on('pedido-entregado', function() {
            Swal.fire({
                icon: 'success',
                title: 'Entregado',
                text: 'El pedido se marcó como entregado',
                confirmButtonColor: '#28a745',
                confirmButtonText: 'Aceptar'
            });
        });
    </script>
</div>
