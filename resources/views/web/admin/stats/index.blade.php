@extends('layouts.admin')

@section('title', 'Estadísticas de Analítica - BANDTEL Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
    <div>
        <h1 class="h3 font-weight-bold text-dark mb-1">
            <i class="fas fa-chart-bar text-primary mr-2"></i>Estadísticas y Analítica de Visitas
        </h1>
        <p class="text-muted small mb-0">Monitoreo de interacciones, métricas de acceso y tráfico público por región</p>
    </div>
</div>

{{-- FILTROS DE PERÍODO Y REGIÓN --}}
<div class="card card-outline card-primary shadow-sm rounded-lg mb-4" data-aos="fade-up">
    <div class="card-body p-3">
        <form action="{{ route('admin.stats.index') }}" method="GET" class="form-inline justify-content-between">
            <div class="d-flex align-items-center mb-2 mb-md-0">
                <label class="font-weight-bold text-muted mr-2 small">Período:</label>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-outline-primary btn-sm rounded-pill font-weight-bold {{ $period == 'daily' ? 'active' : '' }} mr-1">
                        <input type="radio" name="period" value="daily" onchange="this.form.submit()" {{ $period == 'daily' ? 'checked' : '' }}> Hoy
                    </label>
                    <label class="btn btn-outline-primary btn-sm rounded-pill font-weight-bold {{ $period == 'weekly' ? 'active' : '' }} mr-1">
                        <input type="radio" name="period" value="weekly" onchange="this.form.submit()" {{ $period == 'weekly' ? 'checked' : '' }}> Últimos 7 días
                    </label>
                    <label class="btn btn-outline-primary btn-sm rounded-pill font-weight-bold {{ $period == 'monthly' ? 'active' : '' }}">
                        <input type="radio" name="period" value="monthly" onchange="this.form.submit()" {{ $period == 'monthly' ? 'checked' : '' }}> Últimos 30 días
                    </label>
                </div>
            </div>

            <div class="d-flex align-items-center">
                <label class="font-weight-bold text-muted mr-2 small">Filtrar por Región:</label>
                <select name="region_id" class="form-control custom-select rounded-pill form-control-sm" onchange="this.form.submit()">
                    <option value="">Todas las Regiones</option>
                    @foreach($regions as $region)
                        <option value="{{ $region->id }}" {{ $regionId == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
</div>

{{-- TABLA RESUMEN DE MÉTRICAS --}}
<div class="card card-outline card-primary shadow-sm rounded-lg overflow-hidden" data-aos="fade-up">
    <div class="card-body p-0 table-responsive">
        <table class="table table-hover table-striped table-valign-middle mb-0">
            <thead class="thead-dark">
                <tr>
                    <th class="py-3 pl-4">Región</th>
                    <th class="py-3">Módulo / Sección</th>
                    <th class="py-3 text-right pr-4">Total de Visualizaciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stats as $row)
                    <tr>
                        <td class="font-weight-bold text-dark pl-4 align-middle">
                            <span class="badge badge-light border px-2 py-1">
                                <i class="fas fa-map-marker-alt text-danger mr-1"></i>{{ $row->region }}
                            </span>
                        </td>
                        <td class="align-middle font-weight-bold text-muted">
                            <i class="fas fa-file-alt text-primary mr-1"></i>{{ $row->page_type }}
                        </td>
                        <td class="text-right align-middle pr-4">
                            <span class="badge badge-primary px-3 py-1 font-weight-bold h6 mb-0 shadow-xs">
                                {{ number_format($row->total_views) }} vistas
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-5 text-muted">
                            <i class="fas fa-chart-line fa-3x mb-3 d-block text-secondary"></i>
                            <p class="mb-0 font-weight-bold">No se registraron datos de analítica para los filtros seleccionados.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection