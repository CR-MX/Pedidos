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
                    <option value="numero_licencia">No. Licencia</option>
                    <option value="curp">CURP</option>
                    <option value="tipo_licencia">Tipo Licencia</option>
                    <option value="fecha_vencimiento">Fecha Vencimiento</option>
                    <option value="nombres">Nombre</option>
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
                    <th>No. Licencia</th>
                    <th>CURP</th>
                    <th>Tipo Licencia</th>
                    <th>Fec. Vencimiento</th>
                    <th>Nombre Completo</th>
                    <th>Acciones</th>
                </tr>
                <tr>
                    <th></th>
                    <th><input wire:model.live.debounce.250ms="search_numero_licencia" type="text"
                            class="form-control" placeholder="Buscar..."></th>
                    <th><input wire:model.live.debounce.250ms="search_curp" type="text" class="form-control"
                            placeholder="Buscar..."></th>
                    <th></th>
                    <th></th>
                    <th><input wire:model.live.debounce.250ms="search_nombre_completo" type="text" class="form-control"
                            placeholder="Buscar..."></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($registros as $credenciale)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $credenciale->numero_licencia ? str_pad($credenciale->numero_licencia, 9, '0', STR_PAD_LEFT) : '' }}</td>
                        <td>{{ $credenciale->curp ?? '' }}</td>
                        <td>{{ $credenciale->tipo_licencia ?? '' }}</td>
                        <td>{{ $credenciale->fecha_vencimiento ?? '' }}</td>
                        <td class="texto-limitado">{{ trim(($credenciale->nombres ?? '').' '.($credenciale->apellido_paterno ?? '').' '.($credenciale->apellido_materno ?? '')) }}</td>
                        <td>
                            <form action="{{ route('credenciales.destroy', $credenciale->id) }}" method="POST">
                                <a class="btn btn-sm btn-success" title="Actualizar"
                                    href="{{ route('credenciales.edit', $credenciale->id) }}"><i
                                        class="fa fa-fw fa-edit"></i></a>
                                @csrf
                                @method('DELETE')
                                <a class="btn btn-sm btn-warning" title="Imprimir"
                                    href="{{ route('credenciales.pdf', $credenciale->id) }}" target="_blank">
                                    <i class="fas fa-print"></i>
                                </a>
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
</div>
