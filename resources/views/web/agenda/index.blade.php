@extends('layouts.web')

@section('title', 'Agenda de Actividades - ' . $region->name)

@section('content')
<style>
    /* Estilos personalizados para la vista Agenda */
    .agenda-hero {
        background: linear-gradient(135deg, rgba(15, 32, 67, 0.9) 0%, rgba(32, 58, 67, 0.85) 100%), 
                    url('https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=1500&q=80') center/cover no-repeat;
        padding: 4rem 0;
    }

    .filter-panel {
        border-radius: 15px;
        border: none;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        margin-top: -2.5rem;
        background: #ffffff;
        position: relative;
        z-index: 10;
    }

    .activity-card {
        border: none;
        border-radius: 16px;
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        background: #ffffff;
    }

    .activity-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12) !important;
    }

    .badge-status-scheduled {
        background-color: #d1e7dd;
        color: #0f5132;
    }

    .badge-status-rescheduled {
        background-color: #fff3cd;
        color: #664d03;
    }

    .badge-status-cancelled {
        background-color: #f8d7da;
        color: #842029;
    }

    .badge-status-completed {
        background-color: #e2e3e5;
        color: #41464b;
    }

    .date-badge {
        display: inline-flex;
        align-items: center;
        background-color: #f8f9fa;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
    }
</style>

<!-- 1. Hero Banner Principal -->
<div class="agenda-hero text-white mb-4">
    <div class="container text-center py-3" data-aos="fade-down">
        <span class="badge badge-warning text-uppercase px-3 py-2 mb-3 font-weight-bold shadow-sm" style="letter-spacing: 1px;">
            Capacitación & Desarrollo Digital
        </span>
        <h1 class="display-4 font-weight-bold mb-2">Agenda de Actividades y Talleres</h1>
        <p class="lead max-w-2xl mx-auto mb-0 text-light" style="font-size: 1.15rem;">
            Consulta las charlas, cursos y eventos programados en los Centros CAD de la Región <strong class="text-warning">{{ $region->name }}</strong>[cite: 1].
        </p>
    </div>
</div>

<div class="container mb-5">

    <!-- 2. Panel de Filtro y Buscador Elevado -->
    <div class="card filter-panel p-3 mb-5" data-aos="zoom-in">
        <div class="card-body p-2">
            <form action="{{ route('agenda.index', ['region' => $region->slug]) }}" method="GET" class="form-row align-items-end">
                <div class="col-md-6 mb-2 mb-md-0">
                    <label class="small font-weight-bold text-muted mb-1">
                        <i class="fas fa-search mr-1 text-primary"></i> Buscar Taller o Tema
                    </label>
                    <div class="input-group">
                        <input type="text" name="search" class="form-control rounded-pill border-right-0" placeholder="Buscar por título, categoría o descripción..." value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-md-4 mb-2 mb-md-0">
                    <label class="small font-weight-bold text-muted mb-1">
                        <i class="fas fa-filter mr-1 text-primary"></i> Estado de la Actividad
                    </label>
                    <select name="status" class="form-control custom-select rounded-pill">
                        <option value="SCHEDULED" {{ request('status', 'SCHEDULED') == 'SCHEDULED' ? 'selected' : '' }}>Programadas</option>
                        <option value="COMPLETED" {{ request('status') == 'COMPLETED' ? 'selected' : '' }}>Realizadas</option>
                        <option value="RESCHEDULED" {{ request('status') == 'RESCHEDULED' ? 'selected' : '' }}>Reprogramadas</option>
                        <option value="CANCELLED" {{ request('status') == 'CANCELLED' ? 'selected' : '' }}>Canceladas</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-block rounded-pill font-weight-bold shadow-sm">
                        <i class="fas fa-search mr-1"></i> Filtrar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 3. Grilla de Tarjetas de Actividades -->
    <div class="row">
        @forelse($activities as $activity)
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                <div class="card h-100 shadow-sm activity-card border-top border-primary" style="border-top-width: 4px !important;">
                    
                    <div class="card-header bg-white pt-4 pb-2 border-0 d-flex justify-content-between align-items-center">
                        <span class="badge badge-pill badge-primary px-3 py-2 text-uppercase font-weight-bold">
                            <i class="fas fa-tag mr-1"></i> {{ $activity->category ?? ($activity->activity_type ?? 'Taller') }}[cite: 1]
                        </span>

                        @if($activity->status == 'SCHEDULED')
                            <span class="badge badge-pill badge-status-scheduled px-3 py-2 font-weight-bold">
                                <i class="fas fa-clock mr-1"></i> Programada[cite: 1]
                            </span>
                        @elseif($activity->status == 'RESCHEDULED')
                            <span class="badge badge-pill badge-status-rescheduled px-3 py-2 font-weight-bold">
                                <i class="fas fa-history mr-1"></i> Reprogramada[cite: 1]
                            </span>
                        @elseif($activity->status == 'CANCELLED')
                            <span class="badge badge-pill badge-status-cancelled px-3 py-2 font-weight-bold">
                                <i class="fas fa-times-circle mr-1"></i> Cancelada[cite: 1]
                            </span>
                        @else
                            <span class="badge badge-pill badge-status-completed px-3 py-2 font-weight-bold">
                                <i class="fas fa-check-circle mr-1"></i> Realizada[cite: 1]
                            </span>
                        @endif
                    </div>

                    <div class="card-body py-2 d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title font-weight-bold text-dark mb-3 mt-1" style="font-size: 1.15rem; line-height: 1.4;">
                                {{ $activity->title }}[cite: 1]
                            </h5>

                            <div class="date-badge text-primary mb-3 w-100">
                                <i class="far fa-calendar-alt mr-2 text-primary fa-lg"></i>
                                <span>{{ $activity->start_datetime->format('d/m/Y - h:i A') }}</span>[cite: 1]
                            </div>

                            <p class="card-text text-secondary small mb-2">
                                <i class="fas fa-map-marker-alt text-danger mr-2"></i> <strong>Centro:</strong> {{ $activity->center->name }} ({{ $activity->center->locality }})[cite: 1]
                            </p>

                            <p class="card-text text-muted small mb-3">
                                {{ Str::limit($activity->description, 110) }}[cite: 1]
                            </p>
                        </div>
                    </div>

                    <div class="card-footer bg-light border-top-0 rounded-bottom py-3 d-flex justify-content-between align-items-center">
                        <small class="text-muted font-weight-bold">
                            <i class="fas fa-users text-info mr-1"></i> {{ $activity->target_audience ?? 'Población General' }}[cite: 1]
                        </small>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12 py-5 text-center text-muted bg-light rounded-lg shadow-sm" data-aos="fade-in">
                <i class="far fa-calendar-times fa-4x text-muted mb-3"></i>
                <h5 class="font-weight-bold text-dark">No se encontraron actividades registradas</h5>
                <p class="mb-0">No hay talleres disponibles para el criterio de búsqueda seleccionado en la región {{ $region->name }}.</p>
            </div>
        @endforelse
    </div>

    <!-- 4. Paginación Normalizada -->
    <div class="d-flex justify-content-center mt-4 mb-5" data-aos="fade-up">
        {{ $activities->appends(request()->query())->links('pagination::bootstrap-4') }}
    </div>

</div>
@endsection