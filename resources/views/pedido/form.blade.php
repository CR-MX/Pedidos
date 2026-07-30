<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="nombre" class="form-label">{{ __('Nombre') }}</label>
            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $pedido?->nombre) }}" id="nombre" placeholder="Nombre">
            {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="red_social" class="form-label">{{ __('Red Social') }}</label>
            <input type="text" name="red_social" class="form-control @error('red_social') is-invalid @enderror" value="{{ old('red_social', $pedido?->red_social) }}" id="red_social" placeholder="Red Social">
            {!! $errors->first('red_social', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="anticipo" class="form-label">{{ __('Anticipo') }}</label>
            <input type="text" name="anticipo" class="form-control @error('anticipo') is-invalid @enderror" value="{{ old('anticipo', $pedido?->anticipo) }}" id="anticipo" placeholder="Anticipo">
            {!! $errors->first('anticipo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="fecha_hora_entrega" class="form-label">{{ __('Fecha Hora Entrega') }}</label>
            <input type="text" name="fecha_hora_entrega" class="form-control @error('fecha_hora_entrega') is-invalid @enderror" value="{{ old('fecha_hora_entrega', $pedido?->fecha_hora_entrega) }}" id="fecha_hora_entrega" placeholder="Fecha Hora Entrega">
            {!! $errors->first('fecha_hora_entrega', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="lugar_id" class="form-label">{{ __('Lugar Id') }}</label>
            <input type="text" name="lugar_id" class="form-control @error('lugar_id') is-invalid @enderror" value="{{ old('lugar_id', $pedido?->lugar_id) }}" id="lugar_id" placeholder="Lugar Id">
            {!! $errors->first('lugar_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="informacion_adicional" class="form-label">{{ __('Informacion Adicional') }}</label>
            <input type="text" name="informacion_adicional" class="form-control @error('informacion_adicional') is-invalid @enderror" value="{{ old('informacion_adicional', $pedido?->informacion_adicional) }}" id="informacion_adicional" placeholder="Informacion Adicional">
            {!! $errors->first('informacion_adicional', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>