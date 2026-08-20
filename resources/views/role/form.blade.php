<div class="row">
    <div class="col-sm-6 form-group">
        <label for="name" class="form-label">Nombre <span style="color:red">*</span></label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $role->name) }}" placeholder="Nombre" required>
        @error('name')
            <div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>
        @enderror
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h5 class="mb-3">Selecciona los permisos del rol</h5>
        <hr>
        @forelse ($permissions as $permission)
            <div class="form-check mb-2">
                <input type="checkbox" class="form-check-input" name="permissions[]" value="{{ $permission->id }}"
                    id="permission_{{ $permission->id }}"
                    {{ isset($role->id) && $role->hasPermissionTo($permission) ? 'checked' : '' }}>
                <label class="form-check-label" for="permission_{{ $permission->id }}">
                    {{ $permission->name }}
                </label>
            </div>
        @empty
            <p class="text-muted">No hay permisos registrados.</p>
        @endforelse
    </div>
</div>

<br>
<div class="row d-flex justify-content-center">
    <a href="{{ route('roles.index') }}" class="btn btn-danger col col-sm-2">{{ __('Cancelar') }}</a>
    <div class="col col-sm-2"></div>
    <button type="submit" class="btn btn-primary col col-sm-2">Guardar</button>
</div>