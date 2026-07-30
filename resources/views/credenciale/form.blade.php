<div class="row padding-1 p-1">
    <div class="col-md-12">
        <div class="row">
            <div class="col">
                <div class="form-group mb-2 mb20">
                    <label for="foto" class="form-label">{{ __('Foto') }}</label>
                    <div class="row">
                        <div class="col-8">
                            <input type="file" name="foto_file" id="file-foto"
                                accept="image/*" class="form-control">
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-outline-secondary"
                                onclick="abrirCamaraFoto()">
                                <i class="fas fa-camera"></i> Cámara
                            </button>
                        </div>
                    </div>
                    <div id="preview-foto" class="mt-2"></div>
                    <input type="hidden" name="foto" id="foto"
                        value="{{ old('foto', $credenciale?->foto) }}">
                    {!! $errors->first('foto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>
            <div class="col"></div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group mb-2 mb20">
                    <label for="curp" class="form-label">{{ __('CURP') }}</label>
                    <input type="text" name="curp" class="form-control @error('curp') is-invalid @enderror"
                        value="{{ old('curp', $credenciale?->curp) }}" id="curp" placeholder="CURP" maxlength="18">
                    {!! $errors->first('curp', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>
            <div class="col"></div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group mb-2 mb20">
                    <label for="apellido_paterno" class="form-label">{{ __('Apellido Paterno') }}</label>
                    <input type="text" name="apellido_paterno"
                        class="form-control @error('apellido_paterno') is-invalid @enderror"
                        value="{{ old('apellido_paterno', $credenciale?->apellido_paterno) }}" id="apellido_paterno"
                        placeholder="Apellido Paterno" maxlength="40">
                    {!! $errors->first(
                        'apellido_paterno',
                        '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
                    ) !!}
                </div>
            </div>
            <div class="col">
                <div class="form-group mb-2 mb20">
                    <label for="apellido_materno" class="form-label">{{ __('Apellido Materno') }}</label>
                    <input type="text" name="apellido_materno"
                        class="form-control @error('apellido_materno') is-invalid @enderror"
                        value="{{ old('apellido_materno', $credenciale?->apellido_materno) }}" id="apellido_materno"
                        placeholder="Apellido Materno" maxlength="40">
                    {!! $errors->first(
                        'apellido_materno',
                        '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
                    ) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group mb-2 mb20">
                    <label for="nombres" class="form-label">{{ __('Nombres') }}</label>
                    <input type="text" name="nombres" class="form-control @error('nombres') is-invalid @enderror"
                        value="{{ old('nombres', $credenciale?->nombres) }}" id="nombres" placeholder="Nombres"
                        maxlength="50">
                    {!! $errors->first('nombres', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>
            <div class="col"></div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group mb-2 mb20">
                    <label for="sexo" class="form-label">{{ __('Sexo') }}</label>
                    <select name="sexo" class="form-control @error('sexo') is-invalid @enderror" id="sexo">
                        <option value="">Seleccione...</option>
                        <option value="M" {{ old('sexo', $credenciale?->sexo) == 'M' ? 'selected' : '' }}>
                            Masculino
                        </option>
                        <option value="F" {{ old('sexo', $credenciale?->sexo) == 'F' ? 'selected' : '' }}>Femenino
                        </option>
                    </select>
                    {!! $errors->first('sexo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>
            <div class="col">
                <div class="form-group mb-2 mb20">
                    <label for="fecha_nacimiento" class="form-label">{{ __('Fecha de Nacimiento') }}</label>
                    <input type="date" name="fecha_nacimiento"
                        class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                        value="{{ old('fecha_nacimiento', $credenciale?->fecha_nacimiento) }}" id="fecha_nacimiento">
                    {!! $errors->first(
                        'fecha_nacimiento',
                        '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
                    ) !!}
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col">
                <div class="form-group mb-2 mb20">
                    <label for="tipo_sangre" class="form-label">{{ __('Tipo de Sangre') }}</label>
                    <select name="tipo_sangre" class="form-control @error('tipo_sangre') is-invalid @enderror"
                        id="tipo_sangre">
                        <option value="">Seleccione...</option>
                        @foreach (['O+', 'O-', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'] as $sangre)
                            <option value="{{ $sangre }}"
                                {{ old('tipo_sangre', $credenciale?->tipo_sangre) == $sangre ? 'selected' : '' }}>
                                {{ $sangre }}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('tipo_sangre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>
            <div class="col">
                <div class="form-group mb-2 mb20">
                    <label for="donador_organos" class="form-label">{{ __('Donador de Órganos') }}</label>
                    <select name="donador_organos" class="form-control @error('donador_organos') is-invalid @enderror"
                        id="donador_organos">
                        <option value="">Seleccione...</option>
                        <option value="1"
                            {{ old('donador_organos', $credenciale?->donador_organos) == '1' ? 'selected' : '' }}>Sí
                        </option>
                        <option value="0"
                            {{ old('donador_organos', $credenciale?->donador_organos) == '0' ? 'selected' : '' }}>No
                        </option>
                    </select>
                    {!! $errors->first(
                        'donador_organos',
                        '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
                    ) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group mb-2 mb20">
                    <label for="restricciones" class="form-label">{{ __('Restricciones') }}</label>
                    <input type="text" name="restricciones"
                        class="form-control @error('restricciones') is-invalid @enderror"
                        value="{{ old('restricciones', $credenciale?->restricciones) }}" id="restricciones"
                        placeholder="Restricciones" maxlength="50">
                    {!! $errors->first(
                        'restricciones',
                        '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
                    ) !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group mb-2 mb20">
                    <label for="tipo_licencia" class="form-label">{{ __('Tipo de Licencia') }}</label>
                    <select name="tipo_licencia" class="form-control @error('tipo_licencia') is-invalid @enderror"
                        id="tipo_licencia">
                        <option value="">Seleccione...</option>
                        <option value="A"
                            {{ old('tipo_licencia', $credenciale?->tipo_licencia) == 'A' ? 'selected' : '' }}>A -
                            Motocicletas
                        </option>
                        <option value="B"
                            {{ old('tipo_licencia', $credenciale?->tipo_licencia) == 'B' ? 'selected' : '' }}>B -
                            Automóviles
                        </option>
                        <option value="C"
                            {{ old('tipo_licencia', $credenciale?->tipo_licencia) == 'C' ? 'selected' : '' }}>C -
                            Pesados
                        </option>
                    </select>
                    {!! $errors->first(
                        'tipo_licencia',
                        '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
                    ) !!}
                </div>
            </div>
            <div class="col">
                <div class="form-group mb-2 mb20">
                    <label for="oficina_emisora_id" class="form-label">{{ __('Oficina Emisora') }}</label>
                    <select name="oficina_emisora_id"
                        class="form-control @error('oficina_emisora_id') is-invalid @enderror"
                        id="oficina_emisora_id">
                        <option value="">Seleccione Opción</option>
                        @foreach ($oficinasEmisoras as $oficina)
                            <option value="{{ $oficina->id }}"
                                {{ old('oficina_emisora_id', $credenciale?->oficina_emisora_id) == $oficina->id ? 'selected' : '' }}>
                                {{ $oficina->nombre }}
                            </option>
                        @endforeach
                    </select>
                    {!! $errors->first(
                        'oficina_emisora_id',
                        '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
                    ) !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group mb-2 mb20">
                    <label for="fecha_expedicion" class="form-label">{{ __('Fecha de Expedición') }}</label>
                    <input type="date" name="fecha_expedicion"
                        class="form-control @error('fecha_expedicion') is-invalid @enderror"
                        value="{{ old('fecha_expedicion', $credenciale?->fecha_expedicion) }}" id="fecha_expedicion">
                    {!! $errors->first(
                        'fecha_expedicion',
                        '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
                    ) !!}
                </div>
            </div>
            <div class="col">
                <div class="form-group mb-2 mb20">
                    <label for="fecha_vencimiento" class="form-label">{{ __('Fecha de Vencimiento') }}</label>
                    <input type="date" name="fecha_vencimiento"
                        class="form-control @error('fecha_vencimiento') is-invalid @enderror"
                        value="{{ old('fecha_vencimiento', $credenciale?->fecha_vencimiento) }}"
                        id="fecha_vencimiento">
                    {!! $errors->first(
                        'fecha_vencimiento',
                        '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
                    ) !!}
                </div>
            </div>
        </div>











        <hr>
        <h5>En caso de accidente</h5>

        <div class="row">
            <div class="col">
                <div class="form-group mb-2 mb20">
                    <label for="en_caso_accidente_nombre" class="form-label">{{ __('Nombre de contacto') }}</label>
                    <input type="text" name="en_caso_accidente_nombre"
                        class="form-control @error('en_caso_accidente_nombre') is-invalid @enderror"
                        value="{{ old('en_caso_accidente_nombre', $credenciale?->en_caso_accidente_nombre) }}"
                        id="en_caso_accidente_nombre" placeholder="Nombre completo" maxlength="200">
                    {!! $errors->first(
                        'en_caso_accidente_nombre',
                        '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
                    ) !!}
                </div>
            </div>
            <div class="col">
                <div class="form-group mb-2 mb20">
                    <label for="en_caso_accidente_numero" class="form-label">{{ __('Teléfono de contacto') }}</label>
                    <input type="tel" name="en_caso_accidente_numero"
                        class="form-control @error('en_caso_accidente_numero') is-invalid @enderror"
                        value="{{ old('en_caso_accidente_numero', $credenciale?->en_caso_accidente_numero) }}"
                        id="en_caso_accidente_numero" placeholder="Teléfono" maxlength="20">
                    {!! $errors->first(
                        'en_caso_accidente_numero',
                        '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
                    ) !!}
                </div>
            </div>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-group mb-2 mb20 text-center">
                    <label class="form-label d-block">{{ __('Firma') }}</label>
                    <span>

                    </span>
                    <canvas id="firma-canvas" width="400" height="150"
                        style="border:1px solid #ccc; border-radius:4px; cursor:crosshair; background:#fff;">
                    </canvas>

                    <input type="hidden" name="firma" id="firma"
                        value="{{ old('firma', $credenciale?->firma) }}">

                    <div class="mt-2">
                        <button type="button" id="btn-limpiar-firma" class="btn btn-sm btn-outline-danger">
                            <i class="fa fa-eraser"></i> Limpiar firma
                        </button>
                    </div>

                    {!! $errors->first(
                        'firma',
                        '<div class="invalid-feedback d-block" role="alert"><strong>:message</strong></div>',
                    ) !!}
                </div>
            </div>
        </div>

    </div>
</div>
<br>
<div class="row d-flex justify-content-center">
    <a href="{{ route('credenciales.index') }}" class="btn btn-danger col col-sm-2">{{ __('Cancelar') }}</a>
    <div class="col col-sm-2"></div>
    <button type="submit" id="btn-aceptar"
        class="btn btn-primary col col-sm-2">Guardar</button>
</div>

{{-- Modal Camara --}}
<div id="camera-modal"
    style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.7); z-index:9999; align-items:center; justify-content:center;">
    <div style="background:#fff; border-radius:12px; padding:1rem; text-align:center; max-width:480px; width:95%;">
        <div style="position:relative; overflow:hidden; border-radius:8px;">
            <video id="camera-video" autoplay playsinline style="width:100%; display:block;"></video>
            <div id="camera-guide"
                style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; pointer-events:none;">
                <div id="guide-frame"
                    style="border:2px dashed rgba(255,255,255,.8); border-radius:8px;
                           box-shadow: 0 0 0 9999px rgba(0,0,0,.45);
                           width:60%; aspect-ratio:295/354;">
                </div>
            </div>
        </div>
        <div class="d-flex gap-2 mt-2 justify-content-center">
            <span class="p-2">
                <button type="button" class="btn btn-primary" id="capture-btn">
                    <i class="fas fa-camera"></i> Capturar
                </button>
            </span>
            <span class="p-2">
                <button type="button" class="btn btn-outline-secondary" id="switch-camera-btn">
                    <i class="fas fa-sync-alt"></i> Cambiar
                </button>
            </span>
            <span class="p-2">
                <button type="button" class="btn btn-secondary" id="close-camera-btn">Cerrar</button>
            </span>
        </div>
        <canvas id="camera-canvas" style="display:none;"></canvas>
    </div>
</div>
