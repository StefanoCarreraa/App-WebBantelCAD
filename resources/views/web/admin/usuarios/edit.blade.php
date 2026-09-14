@extends('layouts.admin')

@section('title', 'Editar Usuario: ' . $user->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
    <div>
        <h1 class="h3 font-weight-bold text-dark mb-1">
            <i class="fas fa-user-edit text-warning mr-2"></i>Editar Usuario: {{ $user->name }}
        </h1>
        <p class="text-muted small mb-0">Modifique los datos o actualice el nivel de acceso del usuario</p>
    </div>
    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill font-weight-bold">
        <i class="fas fa-arrow-left mr-1"></i> Volver al listado
    </a>
</div>

<div class="card card-outline card-warning shadow-sm rounded-lg" data-aos="fade-up">
    <form action="{{ route('admin.usuarios.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body p-4">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label class="small font-weight-bold text-muted">Nombre Completo <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control rounded-pill @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                    @error('name') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label class="small font-weight-bold text-muted">Correo Electrónico <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control rounded-pill @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                    @error('email') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4 form-group">
                    <label class="small font-weight-bold text-muted">Rol de Usuario <span class="text-danger">*</span></label>
                    <select name="role" class="form-control custom-select rounded-pill @error('role') is-invalid @enderror" required>
                        <option value="ADMIN" {{ old('role', $user->role) == 'ADMIN' ? 'selected' : '' }}>Administrador (Full)</option>
                        <option value="CONTENT_MANAGER" {{ old('role', $user->role) == 'CONTENT_MANAGER' ? 'selected' : '' }}>Gestor de Contenido</option>
                        <option value="VIEWER" {{ old('role', $user->role) == 'VIEWER' ? 'selected' : '' }}>Visualizador / Auditor</option>
                    </select>
                    @error('role') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4 form-group">
                    <label class="small font-weight-bold text-muted">Nueva Contraseña (Opcional)</label>
                    <input type="password" name="password" class="form-control rounded-pill @error('password') is-invalid @enderror" placeholder="Dejar en blanco para no cambiar">
                    @error('password') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4 form-group">
                    <label class="small font-weight-bold text-muted">Confirmar Nueva Contraseña</label>
                    <input type="password" name="password_confirmation" class="form-control rounded-pill">
                </div>
            </div>
        </div>
        <div class="card-footer text-right bg-light py-3">
            <button type="submit" class="btn btn-warning rounded-pill px-4 font-weight-bold text-dark shadow-sm">
                <i class="fas fa-sync-alt mr-1"></i> Actualizar Usuario
            </button>
        </div>
    </form>
</div>
@endsection