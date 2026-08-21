<div class="row padding-1 p-1">
    <div class="col-md-12">

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row">
            <div class="col">
                <div class="form-group mb-2 mb20">
                    <label for="nombre" class="form-label">{{ __('Nombre') }} <span style="color:red">*</span></label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                        value="{{ old('nombre', $pedido?->nombre) }}" id="nombre" placeholder="Nombre">
                    {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>
            <div class="col">
                <div class="form-group mb-2 mb20">
                    <label for="red_social" class="form-label">{{ __('Red Social') }}</label>
                    <select name="red_social" class="form-control @error('red_social') is-invalid @enderror"
                        id="red_social">
                        <option value="">Seleccione...</option>
                        <option value="Facebook"
                            {{ old('red_social', $pedido?->red_social) == 'Facebook' ? 'selected' : '' }}>Facebook
                        </option>
                        <option value="Instagram"
                            {{ old('red_social', $pedido?->red_social) == 'Instagram' ? 'selected' : '' }}>Instagram
                        </option>
                        <option value="WhatsApp"
                            {{ old('red_social', $pedido?->red_social) == 'WhatsApp' ? 'selected' : '' }}>WhatsApp
                        </option>
                    </select>
                    {!! $errors->first('red_social', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col">
                <div class="form-group mb-2 mb20">
                    <label for="anticipo" class="form-label">{{ __('Anticipo') }} <span style="color:red">*</span></label>
                    <input type="number" name="anticipo" class="form-control @error('anticipo') is-invalid @enderror"
                        value="{{ old('anticipo', $pedido?->anticipo) }}" id="anticipo" placeholder="Anticipo"
                        step="0.01">
                    {!! $errors->first('anticipo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>
            <div class="col">
                <div class="form-group mb-2 mb20">
                    <label for="total" class="form-label">{{ __('Total') }} <span style="color:red">*</span></label>
                    <input type="number" name="total" class="form-control @error('total') is-invalid @enderror"
                        value="{{ old('total', $pedido?->total) }}" id="total" placeholder="Total" step="0.01">
                    {!! $errors->first('total', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group mb-2 mb20">
                    <label for="fecha_hora_entrega" class="form-label">{{ __('Fecha Hora Entrega') }}</label>
                    <input type="datetime-local" name="fecha_hora_entrega"
                        class="form-control @error('fecha_hora_entrega') is-invalid @enderror"
                        value="{{ old('fecha_hora_entrega', $pedido?->fecha_hora_entrega) }}" id="fecha_hora_entrega">
                    {!! $errors->first(
                        'fecha_hora_entrega',
                        '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
                    ) !!}
                </div>
            </div>
            <div class="col">
                <div class="form-group mb-2 mb20">
                    <label for="lugar_id" class="form-label">{{ __('Lugar') }}</label>
                    <select name="lugar_id" class="form-control @error('lugar_id') is-invalid @enderror" id="lugar_id">
                        <option value="">Seleccione Opción</option>
                        @foreach ($lugares as $lugar)
                            <option value="{{ $lugar->id }}"
                                {{ old('lugar_id', $pedido?->lugar_id) == $lugar->id ? 'selected' : '' }}>
                                {{ $lugar->nombre }}
                            </option>
                        @endforeach
                    </select>
                    {!! $errors->first('lugar_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>
            <div class="col">
                <div class="form-group mb-2 mb20">
                    <label for="entrega" class="form-label">{{ __('Entrega') }}</label>
                    <select name="entrega" class="form-control @error('entrega') is-invalid @enderror" id="entrega">
                        <option value="pendiente" {{ old('entrega', $pedido?->entrega) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="entregado" {{ old('entrega', $pedido?->entrega) == 'entregado' ? 'selected' : '' }}>Entregado</option>
                    </select>
                    {!! $errors->first('entrega', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>
        </div>

        <div id="pedidos-misma-fecha" class="row" style="display:none;">
            <div class="col">
                <div class="form-group mb-2 mb20">
                    <label>Pedidos del día</label>
                    <div class="table-responsive">
                        <table class="table  table-sm table-striped table-bordered">
                            <thead>
                                <tr class="table-primary">
                                    <th>Nombre</th>
                                    <th>Lugar</th>
                                    <th>Hora</th>
                                </tr>
                            </thead>
                            <tbody id="tbody-misma-fecha"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group mb-2 mb20">
                    <label for="informacion_adicional" class="form-label">{{ __('Información Adicional') }}</label>
                    <textarea name="informacion_adicional" class="form-control @error('informacion_adicional') is-invalid @enderror"
                        id="informacion_adicional" placeholder="Información Adicional" rows="3">{{ old('informacion_adicional', $pedido?->informacion_adicional) }}</textarea>
                    {!! $errors->first(
                        'informacion_adicional',
                        '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
                    ) !!}
                </div>
            </div>
        </div>

        <hr>
        <h5>Artículos del Pedido <span style="color:red">*</span></h5>
        <div class="table-responsive">
            <table class="table table-sm table-striped table-bordered" id="tabla-articulos">
                <thead>
                    <tr class="table-success">
                        <th>Nombre/Descripción <span style="color:red">*</span>
                            <br>
                            <input type="text" id="art-nombre" class="form-control" placeholder="Nombre">
                        </th>
                        <th>Color
                            <br>
                            <select id="art-color" class="form-control">
                                <option value="">Seleccione</option>
                                @foreach ($colores as $color)
                                    <option value="{{ $color->nombre }}">{{ $color->nombre }}</option>
                                @endforeach
                            </select>
                        </th>
                        <th>Cantidad <span style="color:red">*</span>
                            <br>
                            <input type="number" id="art-cantidad" class="form-control" value="1">
                        </th>
                        <th>Tipo <span style="color:red">*</span>
                            <br>
                            <select id="art-tipo_id" class="form-control">
                                <option value="">Seleccione</option>
                                @foreach ($tipos as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                @endforeach
                            </select>
                        </th>
                        <th style="width:80px; text-align:center; vertical-align:middle;">
                            <button type="button" class="btn btn-success btn-sm" onclick="agregarArticulo()">
                                <i class="fas fa-plus"></i>
                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody id="tbody-articulos">
                    @if (isset($pedido->articulosPedidos) && $pedido->articulosPedidos->count() > 0)
                        @foreach ($pedido->articulosPedidos as $i => $art)
                            <tr>
                                <td><input type="text" name="articulos[{{ $i }}][nombre]" class="form-control" value="{{ $art->nombre }}"></td>
                                <td>
                                    <select name="articulos[{{ $i }}][color]" class="form-control">
                                        <option value="">Seleccione</option>
                                        @foreach ($colores as $color)
                                            <option value="{{ $color->nombre }}" {{ $art->color == $color->nombre ? 'selected' : '' }}>{{ $color->nombre }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="number" name="articulos[{{ $i }}][cantidad]" class="form-control" value="{{ $art->cantidad }}"></td>
                                <td>
                                    <select name="articulos[{{ $i }}][tipo_id]" class="form-control">
                                        <option value="">Seleccione</option>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo->id }}" {{ $art->tipo_id == $tipo->id ? 'selected' : '' }}>{{ $tipo->nombre }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td style="text-align:center; vertical-align:middle;">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="eliminarArticulo(this)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Template oculto para nueva fila -->
        <template id="template-articulo">
            <tr>
                <td><input type="text" name="articulos[__INDEX__][nombre]" class="form-control" placeholder="Nombre"></td>
                <td>
                    <select name="articulos[__INDEX__][color]" class="form-control">
                        <option value="">Seleccione</option>
                        @foreach ($colores as $color)
                            <option value="{{ $color->nombre }}">{{ $color->nombre }}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="number" name="articulos[__INDEX__][cantidad]" class="form-control" value="1"></td>
                <td>
                    <select name="articulos[__INDEX__][tipo_id]" class="form-control">
                        <option value="">Seleccione</option>
                        @foreach ($tipos as $tipo)
                            <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                        @endforeach
                    </select>
                </td>
                <td style="text-align:center; vertical-align:middle;">
                    <button type="button" class="btn btn-danger btn-sm" onclick="eliminarArticulo(this)">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        </template>

    </div>
</div>
<br>
<div class="row d-flex justify-content-center">
    <a href="{{ route('coco-pedidos.index') }}" class="btn btn-danger col col-sm-2">{{ __('Cancelar') }}</a>
    <div class="col col-sm-2"></div>
    <button type="submit" id="btn-aceptar" class="btn btn-primary col col-sm-2">Guardar</button>
</div>

<script>
    var pedidoActualId = {{ $pedido->id ?? 'null' }};

    function formatearHora(iso) {
        if (!iso) return '';
        var match = iso.match(/(\d{1,2}):(\d{2})/);
        if (!match) return '';
        var hours = parseInt(match[1], 10);
        var minutes = match[2];
        var ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12 || 12;
        return hours + ':' + minutes + ' ' + ampm;
    }

    function cargarPedidosMismaFecha() {
        var input = document.getElementById('fecha_hora_entrega');
        var container = document.getElementById('pedidos-misma-fecha');
        var tbody = document.getElementById('tbody-misma-fecha');

        if (!input || !input.value) {
            container.style.display = 'none';
            return;
        }

        var date = input.value.split('T')[0];
        var url = '/coco-pedidos-por-fecha?date=' + date;
        if (pedidoActualId) url += '&exclude=' + pedidoActualId;

        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(function (r) { return r.json(); })
            .then(function (data) {
                tbody.innerHTML = '';
                if (data.length === 0) {
                    container.style.display = 'none';
                    return;
                }
                data.forEach(function (p) {
                    var tr = document.createElement('tr');
                    tr.innerHTML = '<td>' + p.nombre + '</td>' +
                        '<td>' + (p.lugar || '') + '</td>' +
                        '<td>' + formatearHora(p.fecha_hora_entrega) + '</td>';
        tbody.insertBefore(tr, tbody.firstChild);
                });
                container.style.display = '';
            });
    }

    document.addEventListener('DOMContentLoaded', function () {
        var input = document.getElementById('fecha_hora_entrega');
        if (input) {
            input.addEventListener('change', cargarPedidosMismaFecha);
            cargarPedidosMismaFecha();
        }

        document.getElementById('btn-aceptar').closest('form').addEventListener('submit', function (e) {
            var total = parseFloat(document.getElementById('total').value);
            var anticipo = parseFloat(document.getElementById('anticipo').value);
            if (!isNaN(total) && !isNaN(anticipo) && total < anticipo) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El total debe ser mayor que el anticipo',
                });
            }
        });
    });

    var articuloIndex = {{ isset($pedido->articulosPedidos) ? $pedido->articulosPedidos->count() : 0 }};

    function agregarArticulo() {
        var template = document.getElementById('template-articulo');
        var tbody = document.getElementById('tbody-articulos');
        var html = template.innerHTML.replace(/__INDEX__/g, articuloIndex);
        var tr = document.createElement('tr');
        tr.innerHTML = html;
        tr.querySelector('input[name="articulos[' + articuloIndex + '][nombre]"]').value = document.getElementById('art-nombre').value;
        tr.querySelector('select[name="articulos[' + articuloIndex + '][color]"]').value = document.getElementById('art-color').value;
        tr.querySelector('input[name="articulos[' + articuloIndex + '][cantidad]"]').value = document.getElementById('art-cantidad').value;
        tr.querySelector('select[name="articulos[' + articuloIndex + '][tipo_id]"]').value = document.getElementById('art-tipo_id').value;
        tbody.prepend(tr);
        articuloIndex++;
        var nombreInput = document.getElementById('art-nombre');
        nombreInput.focus();
        nombreInput.select();
    }

    function eliminarArticulo(btn) {
        var tr = btn.closest('tr');
        if (tr) {
            tr.remove();
        }
    }
</script>
