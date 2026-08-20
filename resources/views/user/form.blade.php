<div class="row">
    <div class="col-sm-6 form-group">
        <label for="name" class="form-label">Nombre <span style="color:red">*</span></label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $user->name) }}" placeholder="Nombre" required>
        @error('name')
            <div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>
        @enderror
    </div>
    <div class="col-sm-6 form-group">
        <label for="email" class="form-label">Correo <span style="color:red">*</span></label>
        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email', $user->email) }}" placeholder="Correo" required>
        @error('email')
            <div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>
        @enderror
    </div>
</div>

@if (isset($user->id))
    <div class="row">
        <div class="col-12 form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="update_pass" name="update_pass"
                    onchange="cambioSwitch()" {{ old('update_pass') ? 'checked' : '' }}>
                <label for="update_pass" class="custom-control-label">Actualizar Contraseña</label>
            </div>
        </div>
    </div>
@endif

<div id="zone_update_pass" style="{{ isset($user->id) ? 'display: none;' : '' }}">
    <div class="row">
        <div class="col-sm-6 form-group">
            <label for="password" class="form-label">Contraseña <span style="color:red">*</span></label>
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
                placeholder="Contraseña" @if (!isset($user->id)) required @endif>
            @error('password')
                <div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
        <div class="col-sm-6 form-group">
            <label for="password_confirmation" class="form-label">Confirmar Contraseña <span style="color:red">*</span></label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                placeholder="Confirmar Contraseña" @if (!isset($user->id)) required @endif>
        </div>
    </div>
</div>

<div class="card p-3">
    <label class="form-label">Roles:</label>
    <div class="row">
        @foreach ($roles as $rol)
            <div class="col-md-4 mb-2">
                <div class="d-flex align-items-center">
                    <input type="checkbox" name="roles[]" value="{{ $rol->id }}" id="rol_{{ $rol->id }}"
                        {{ isset($user->id) && $user->hasRole($rol) ? 'checked' : '' }}>
                    <label for="rol_{{ $rol->id }}" class="mb-0 ml-2" style="font-weight: normal">
                        {{ $rol->name }}
                    </label>
                </div>
            </div>
        @endforeach
    </div>
</div>

<br>
<div class="row d-flex justify-content-center">
    <a href="{{ route('user.index') }}" class="btn btn-danger col col-sm-2">{{ __('Cancelar') }}</a>
    <div class="col col-sm-2"></div>
    <button type="submit" class="btn btn-primary col col-sm-2">Guardar</button>
</div>

<script>
    function cambioSwitch() {
        var zone = document.getElementById('zone_update_pass');
        zone.style.display = zone.style.display === 'none' ? 'block' : 'none';
    }
</script>