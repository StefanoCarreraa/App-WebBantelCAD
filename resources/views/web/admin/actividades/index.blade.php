@extends('layouts.admin')

@section('title', 'Agenda y Gestión de Actividades')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
    <div>
        <h1 class="h3 font-weight-bold text-dark mb-1">
            <i class="fas fa-calendar-alt text-success mr-2"></i>Agenda y Actividades Registradas
        </h1>
        <p class="text-muted small mb-0">Control de talleres, capacitaciones y actividades operativas en los centros CAD / CAU</p>
    </div>
    <a href="{{ route('admin.actividades.create') }}" class="btn btn-success btn-sm rounded-pill font-weight-bold shadow-sm">
        <i class="fas fa-plus mr-1"></i> Nueva Actividad
    </a>
</div>

<form method="GET" action="{{ route('admin.actividades.index') }}" class="card card-outline card-success mb-4">
    <div class="card-body py-3">
        <div class="input-group">
            <input type="search" name="search" value="{{ request('search') }}" class="form-control rounded-left" placeholder="Buscar por título, descripción, categoría, responsable, estado, código o nombre del centro...">
            <div class="input-group-append">
                <button class="btn btn-success" type="submit"><i class="fas fa-search mr-1"></i>Buscar</button>
                @if(request('search'))
                    <a href="{{ route('admin.actividades.index') }}" class="btn btn-outline-secondary">Limpiar</a>
                @endif
            </div>
        </div>
    </div>
</form>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-lg shadow-sm" data-aos="fade-in">
        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
@endif

<div class="card card-custom card-outline card-success" data-aos="fade-up">
    <div class="card-body p-0 table-responsive">
        <table class="table table-hover table-striped table-valign-middle mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>Actividad</th>
                    <th>Centro Relacionado</th>
                    <th>Fecha y Hora</th>
                    <th>Responsable</th>
                    <th class="text-center">Asistentes</th>
                    <th class="text-center">Estado</th>
                    <th class="text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($activities as $activity)
                    <tr>
                        <td class="font-weight-bold text-dark">
                            {{ $activity->title }}
                            @if($activity->evidences_count > 0 || $activity->evidences->count() > 0)
                                <small class="badge badge-info ml-1" title="Evidencias adjuntas"><i class="fas fa-paperclip"></i> {{ $activity->evidences->count() }}</small>
                            @endif
                        </td>
                        <td><span class="badge badge-light border">{{ $activity->center->name ?? 'Centro General' }}</span></td>
                        <td>
                            <small class="text-dark font-weight-bold d-block">
                                <i class="far fa-calendar-alt text-primary mr-1"></i>{{ $activity->start_datetime->format('d/m/Y') }}
                            </small>
                            <small class="text-muted"><i class="far fa-clock mr-1"></i>{{ $activity->start_datetime->format('h:i A') }}</small>
                        </td>
                        <td><small class="text-muted">{{ $activity->responsable_name ?? 'Sin asignar' }}</small></td>
                        <td class="text-center">
                            <span class="badge badge-secondary px-2 py-1"><i class="fas fa-users mr-1"></i>{{ $activity->attendees_count ?? 0 }}</span>
                        </td>
                        <td class="text-center">
                            <span class="badge badge-{{ $activity->status === 'COMPLETED' ? 'success' : ($activity->status === 'SCHEDULED' ? 'info' : ($activity->status === 'RESCHEDULED' ? 'warning' : 'danger')) }} px-3 py-1 font-weight-bold">
                                {{ $activity->status }}
                            </span>
                        </td>
                        <td class="text-right">
                            <a href="{{ route('admin.actividades.edit', $activity) }}" class="btn btn-sm btn-outline-warning rounded-circle" title="Editar"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.actividades.destroy', $activity) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Confirma la eliminación permanente de esta actividad?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger rounded-circle" title="Eliminar"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center py-5 text-muted"><i class="fas fa-calendar-times fa-2x mb-2 d-block"></i>No hay actividades agendadas o registradas.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="d-flex justify-content-center mt-4">
    {{ $activities->links('pagination::bootstrap-4') }}
</div>
@endsection