@extends('layouts.admin')

@section('title', 'Gestión de Centros CAD / CAU')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
    <div>
        <h1 class="h3 font-weight-bold text-dark mb-1"><i class="fas fa-building text-primary mr-2"></i>Gestión de Centros (CAD / CAU)</h1>
        <p class="text-muted small mb-0">Listado e inventario oficial de puntos de acceso digital regional</p>
    </div>
    <a href="{{ route('admin.centers.create') }}" class="btn btn-primary btn-sm rounded-pill font-weight-bold shadow-sm"><i class="fas fa-plus mr-1"></i> Nuevo Centro</a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-lg shadow-sm" data-aos="fade-in">
        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
@endif

<div class="card card-custom card-outline card-primary" data-aos="fade-up">
    <div class="card-body p-0 table-responsive">
        <table class="table table-hover table-striped table-valign-middle mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>Código</th>
                    <th>Nombre del Centro</th>
                    <th>Tipo</th>
                    <th>Región</th>
                    <th>Ubicación</th>
                    <th class="text-center">Estado</th>
                    <th class="text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($centers as $center)
                    <tr>
                        <td><span class="badge badge-dark px-2 py-1 font-weight-bold">{{ $center->code }}</span></td>
                        <td class="font-weight-bold text-dark">{{ $center->name }}</td>
                        <td>
                            <span class="badge badge-{{ $center->type == 'CAU' ? 'danger' : ($center->type == 'CAD_A' ? 'success' : 'info') }} px-2 py-1">
                                {{ str_replace('_', ' ', $center->type) }}
                            </span>
                        </td>
                        <td><span class="badge badge-light border">{{ $center->region->name ?? 'N/A' }}</span></td>
                        <td><small class="text-muted"><i class="fas fa-map-marker-alt text-danger mr-1"></i>{{ $center->province }} - {{ $center->district }}</small></td>
                        <td class="text-center">
                            <span class="badge badge-{{ $center->status == 'OPERATIVE' ? 'success' : ($center->status == 'MAINTENANCE' ? 'warning' : 'danger') }} px-3 py-1 font-weight-bold">
                                {{ $center->status }}
                            </span>
                        </td>
                        <td class="text-right">
                            <a href="{{ route('admin.centers.edit', $center) }}" class="btn btn-sm btn-outline-warning rounded-circle" title="Editar"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.centers.destroy', $center) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Confirma la eliminación permanente de este centro?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger rounded-circle" title="Eliminar"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center py-5 text-muted"><i class="fas fa-folder-open fa-2x mb-2 d-block"></i>No hay centros registrados.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="d-flex justify-content-center mt-4">{{ $centers->links() }}</div>
@endsection