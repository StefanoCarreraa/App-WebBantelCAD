@extends('layouts.admin')

@section('title', 'Recursos Digitales y Enlaces Internos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
    <div>
        <h1 class="h3 font-weight-bold text-dark mb-1">
            <i class="fas fa-folder-open text-primary mr-2"></i>Gestión de Recursos Digitales y Enlaces
        </h1>
        <p class="text-muted small mb-0">Control de manuales, guías PDF y enlaces de interés para los centros CAD / CAU</p>
    </div>
    <a href="{{ route('admin.resources.create') }}" class="btn btn-primary btn-sm rounded-pill font-weight-bold shadow-sm">
        <i class="fas fa-upload mr-1"></i> Subir Nuevo Recurso
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

<div class="card card-outline card-primary shadow-sm rounded-lg overflow-hidden" data-aos="fade-up">
    <div class="card-body p-0 table-responsive">
        <table class="table table-hover table-striped table-valign-middle mb-0">
            <thead class="thead-dark">
                <tr>
                    <th class="py-3 pl-4">Título del Recurso</th>
                    <th class="py-3">Región</th>
                    <th class="py-3">Tipo / Formato</th>
                    <th class="py-3">Fecha de Carga</th>
                    <th class="py-3 text-right pr-4">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($resources as $resource)
                    <tr class="transition-row">
                        <td class="font-weight-bold text-dark pl-4 align-middle">
                            <i class="fas fa-file-pdf text-danger mr-2"></i>{{ Str::limit($resource->title, 55) }}
                        </td>
                        <td class="align-middle">
                            <span class="badge badge-light border px-2 py-1 font-weight-bold">
                                <i class="fas fa-map-marker-alt text-danger mr-1"></i>{{ $resource->region->name ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="align-middle">
                            <span class="badge badge-info px-3 py-1 font-weight-bold shadow-xs">
                                {{ strtoupper($resource->file_type ?? 'PDF') }}
                            </span>
                        </td>
                        <td class="align-middle">
                            <small class="text-dark font-weight-bold d-block">
                                <i class="far fa-calendar-alt text-primary mr-1"></i>{{ $resource->created_at ? $resource->created_at->format('d/m/Y') : 'Sin fecha' }}
                            </small>
                        </td>
                        <td class="text-right align-middle pr-4">
                            @if($resource->file_path)
                                <a href="{{ asset('storage/' . $resource->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-circle shadow-xs mr-1" title="Descargar / Ver Documento">
                                    <i class="fas fa-download"></i>
                                </a>
                            @endif
                            <form action="{{ route('admin.resources.destroy', $resource) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Confirma la eliminación permanente de este recurso digital?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle shadow-xs" title="Eliminar Recurso">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="fas fa-folder-open fa-3x mb-3 d-block text-secondary"></i>
                            <p class="mb-0 font-weight-bold">No hay recursos digitales cargados en la plataforma.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center mt-4" data-aos="fade-up">
    {{ $resources->links() }}
</div>
@endsection
