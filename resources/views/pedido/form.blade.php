<div class="row padding-1 p-1">
    <div class="col-md-12">
        <div class="row">
            <div class="col">
                <div class="form-group mb-2 mb20">
                    <label for="nombre" class="form-label">{{ __('Nombre') }}</label>
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
                    <label for="anticipo" class="form-label">{{ __('Anticipo') }}</label>
                    <input type="number" name="anticipo" class="form-control @error('anticipo') is-invalid @enderror"
                        value="{{ old('anticipo', $pedido?->anticipo) }}" id="anticipo" placeholder="Anticipo"
                        step="0.01">
                    {!! $errors->first('anticipo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>
            <div class="col">
                <div class="form-group mb-2 mb20">
                    <label for="total" class="form-label">{{ __('Total') }}</label>
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

    </div>
</div>
<br>
<div class="row d-flex justify-content-center">
    <a href="{{ route('pedidos.index') }}" class="btn btn-danger col col-sm-2">{{ __('Cancelar') }}</a>
    <div class="col col-sm-2"></div>
    <button type="submit" id="btn-aceptar" class="btn btn-primary col col-sm-2">Guardar</button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var input = document.getElementById('fecha_hora_entrega');
        if (input && !input.value) {
            var now = new Date();
            var year = now.getFullYear();
            var month = String(now.getMonth() + 1).padStart(2, '0');
            var day = String(now.getDate()).padStart(2, '0');
            var hours = String(now.getHours()).padStart(2, '0');
            var minutes = String(now.getMinutes()).padStart(2, '0');
            input.value = year + '-' + month + '-' + day + 'T' + hours + ':' + minutes;
        }
    });
</script>
