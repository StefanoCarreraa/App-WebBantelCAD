@extends('layouts.admin')

@section('title', 'Gestión de Usuarios - BANDTEL Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
    <div>
        <h1 class="h3 font-weight-bold text-dark mb-1">
            <i class="fas fa-users-cog text-primary mr-2"></i>Gestión de Usuarios y Roles
        </h1>
        <p class="text-muted small mb-0">Control de acceso y credenciales del personal administrativo</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm rounded-pill font-weight-bold shadow-sm">
        <i class="fas fa-user-plus mr-1"></i> Registrar Nuevo Usuario
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-lg shadow-sm border-0 mb-4" role="alert" data-aos="fade-in">
        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show rounded-lg shadow-sm border-0 mb-4" role="alert" data-aos="fade-in">
        <i class="fas fa-exclamation-triangle mr-2"></i>{{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="card card-outline card-primary shadow-sm rounded-lg overflow-hidden" data-aos="fade-up">
    <div class="card-body p-0 table-responsive">
        <table class="table table-hover table-striped table-valign-middle mb-0">
            <thead class="thead-dark">
                <tr>
                    <th class="py-3 pl-4">Nombre Completo</th>
                    <th class="py-3">Correo Electrónico</th>
                    <th class="py-3 text-center">Rol de Sistema</th>
                    <th class="py-3">Fecha Registro</th>
                    <th class="py-3 text-right pr-4">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="transition-row">
                        <td class="font-weight-bold text-dark pl-4 align-middle">
                            <i class="fas fa-user-circle text-secondary mr-2"></i>{{ $user->name }}
                        </td>
                        <td class="align-middle text-muted font-weight-bold">
                            {{ $user->email }}
                        </td>
                        <td class="text-center align-middle">
                            <span class="badge badge-{{ $user->role === 'ADMIN' ? 'danger' : ($user->role === 'CONTENT_MANAGER' ? 'info' : 'secondary') }} px-3 py-1 font-weight-bold shadow-xs">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="align-middle">
                            <small class="text-muted"><i class="far fa-calendar-alt mr-1"></i>{{ $user->created_at ? $user->created_at->format('d/m/Y') : 'N/A' }}</small>
                        </td>
                        <td class="text-right align-middle pr-4">
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-warning rounded-circle shadow-xs mr-1" title="Editar Usuario">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Confirma la eliminación permanente de este usuario?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle shadow-xs" title="Eliminar Usuario">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="fas fa-users fa-3x mb-3 d-block text-secondary"></i>
                            <p class="mb-0 font-weight-bold">No hay usuarios registrados en el sistema.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center mt-4" data-aos="fade-up">
    {{ $users->links() }}
</div>
@endsection