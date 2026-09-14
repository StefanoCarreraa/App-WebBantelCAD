@extends('layouts.admin')

@section('title', 'Registrar Usuario - BANDTEL Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
    <div>
        <h1 class="h3 font-weight-bold text-dark mb-1">
            <i class="fas fa-user-plus text-primary mr-2"></i>Registrar Nuevo Usuario
        </h1>
        <p class="text-muted small mb-0">Asigne las credenciales y nivel de acceso para la administración del portal</p>
    </div>
    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill font-weight-bold">
        <i class="fas fa-arrow-left mr-1"></i> Volver al listado
    </a>
</div>

<div class="card card-outline card-primary shadow-sm rounded-lg" data-aos="fade-up">
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="card-body p-4">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label class="small font-weight-bold text-muted">Nombre Completo <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control rounded-pill @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Ej: Juan Pérez" required>
                    @error('name') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label class="small font-weight-bold text-muted">Correo Electrónico <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control rounded-pill @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="usuario@cad.gob.pe" required>
                    @error('email') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4 form-group">
                    <label class="small font-weight-bold text-muted">Rol de Usuario <span class="text-danger">*</span></label>
                    <select name="role" class="form-control custom-select rounded-pill @error('role') is-invalid @enderror" required>
                        <option value="ADMIN" {{ old('role') == 'ADMIN' ? 'selected' : '' }}>Administrador (Full)</option>
                        <option value="CONTENT_MANAGER" {{ old('role', 'CONTENT_MANAGER') == 'CONTENT_MANAGER' ? 'selected' : '' }}>Gestor de Contenido</option>
                        <option value="VIEWER" {{ old('role') == 'VIEWER' ? 'selected' : '' }}>Visualizador / Auditor</option>
                    </select>
                    @error('role') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4 form-group">
                    <label class="small font-weight-bold text-muted">Contraseña <span class="text-danger">*</span></label>
                    <input type="password" name="password" class="form-control rounded-pill @error('password') is-invalid @enderror" required>
                    @error('password') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4 form-group">
                    <label class="small font-weight-bold text-muted">Confirmar Contraseña <span class="text-danger">*</span></label>
                    <input type="password" name="password_confirmation" class="form-control rounded-pill" required>
                </div>
            </div>
        </div>
        <div class="card-footer text-right bg-light py-3">
            <button type="submit" class="btn btn-primary rounded-pill px-4 font-weight-bold shadow-sm">
                <i class="fas fa-user-check mr-1"></i> Registrar Usuario
            </button>
        </div>
    </form>
</div>
@endsection