@extends('layouts.admin')

@section('title', 'Dashboard Principal - CAD / CAU')

@section('content')
<div class="content-header mb-3" data-aos="fade-down">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="m-0 text-dark font-weight-bold">Resumen de Control General</h1>
            <p class="text-muted small mb-0">Sistema de monitoreo para las regiones Pasco y Huánuco</p>
        </div>
        <span class="badge badge-warning text-dark px-3 py-2 font-weight-bold shadow-sm">
            <i class="fas fa-clock mr-1"></i> {{ date('d/m/Y') }}
        </span>
    </div>
</div>

<!-- Tarjetas de Estadísticas -->
<div class="row mb-4">
    <div class="col-lg-3 col-6" data-aos="zoom-in" data-aos-delay="100">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $stats['total_centers'] ?? 0 }}</h3>
                <p class="font-weight-bold">Centros CAD/CAU Totales</p>
            </div>
            <div class="icon"><i class="fas fa-building"></i></div>
            <a href="{{ route('admin.centros.index') }}" class="small-box-footer">Gestionar Centros <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6" data-aos="zoom-in" data-aos-delay="200">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $stats['scheduled_activities'] ?? 0 }}</h3>
                <p class="font-weight-bold">Actividades Programadas</p>
            </div>
            <div class="icon"><i class="fas fa-calendar-check"></i></div>
            <a href="{{ route('admin.actividades.index') }}" class="small-box-footer">Ver Agenda <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6" data-aos="zoom-in" data-aos-delay="300">
        <div class="small-box bg-warning">
            <div class="inner text-dark">
                <h3>{{ $stats['published_news'] ?? 0 }}</h3>
                <p class="font-weight-bold">Noticias Publicadas</p>
            </div>
            <div class="icon"><i class="fas fa-newspaper"></i></div>
            <a href="{{ route('admin.noticias.index') }}" class="small-box-footer text-dark">Ver Noticias <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6" data-aos="zoom-in" data-aos-delay="400">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $stats['total_activities'] ?? 0 }}</h3>
                <p class="font-weight-bold">Total Actividades</p>
            </div>
            <div class="icon"><i class="fas fa-tasks"></i></div>
            <a href="{{ route('admin.actividades.index') }}" class="small-box-footer">Historial Completo <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<!-- Gráficos -->
<div class="row">
    <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
        <div class="card card-custom card-outline card-primary h-100">
            <div class="card-header border-0 bg-white py-3">
                <h5 class="card-title font-weight-bold text-dark m-0">
                    <i class="fas fa-chart-pie text-primary mr-2"></i> Distribución de Centros por Tipo
                </h5>
            </div>
            <div class="card-body">
                <canvas id="centersChart" style="min-height: 260px; height: 260px; max-height: 260px; width: 100%;"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
        <div class="card card-custom card-outline card-success h-100">
            <div class="card-header border-0 bg-white py-3">
                <h5 class="card-title font-weight-bold text-dark m-0">
                    <i class="fas fa-chart-bar text-success mr-2"></i> Estado General de Actividades
                </h5>
            </div>
            <div class="card-body">
                <canvas id="activitiesChart" style="min-height: 260px; height: 260px; max-height: 260px; width: 100%;"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Últimas Actividades -->
<div class="row" data-aos="fade-up" data-aos-delay="300">
    <div class="col-md-12">
        <div class="card card-custom card-outline card-dark">
            <div class="card-header border-0 bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="card-title font-weight-bold text-dark mb-0">
                    <i class="fas fa-history text-secondary mr-2"></i> Últimas Actividades Registradas
                </h5>
                <a href="{{ route('admin.actividades.index') }}" class="btn btn-sm btn-outline-primary font-weight-bold rounded-pill">Ver Todo</a>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-hover table-valign-middle mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Título de la Actividad</th>
                            <th>Centro Relacionado</th>
                            <th>Fecha Programada</th>
                            <th class="text-center">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentActivities as $activity)
                            <tr>
                                <td class="font-weight-bold text-primary">{{ $activity->title }}</td>
                                <td><span class="badge badge-light border">{{ $activity->center->name ?? 'N/A' }}</span></td>
                                <td><i class="far fa-clock text-muted mr-1"></i> {{ \Carbon\Carbon::parse($activity->start_datetime)->format('d/m/Y h:i A') }}</td>
                                <td class="text-center">
                                    <span class="badge badge-{{ $activity->status === 'COMPLETED' ? 'success' : ($activity->status === 'SCHEDULED' ? 'info' : 'secondary') }} px-3 py-1 font-weight-bold">
                                        {{ $activity->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center py-4 text-muted"><i class="fas fa-info-circle mr-1"></i> No hay actividades registradas.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        var ctxCenters = document.getElementById('centersChart').getContext('2d');
        var centersData = @json($centersByType);
        new Chart(ctxCenters, {
            type: 'doughnut',
            data: {
                labels: ['CAD Tipo A', 'CAD Tipo B', 'CAU'],
                datasets: [{
                    data: [centersData['CAD_A'] || 0, centersData['CAD_B'] || 0, centersData['CAU'] || 0],
                    backgroundColor: ['#28a745', '#ffc107', '#dc3545'],
                    borderWidth: 2
                }]
            },
            options: { maintainAspectRatio: false, responsive: true, legend: { position: 'bottom' } }
        });

        var ctxActivities = document.getElementById('activitiesChart').getContext('2d');
        var activitiesData = @json($activitiesByStatus);
        new Chart(ctxActivities, {
            type: 'bar',
            data: {
                labels: ['Programadas', 'Realizadas', 'Reprogramadas', 'Canceladas'],
                datasets: [{
                    label: 'Cantidad de Actividades',
                    data: [
                        activitiesData['SCHEDULED'] || 0,
                        activitiesData['COMPLETED'] || 0,
                        activitiesData['RESCHEDULED'] || 0,
                        activitiesData['CANCELLED'] || 0
                    ],
                    backgroundColor: ['#17a2b8', '#28a745', '#ffc107', '#dc3545'],
                    borderRadius: 6
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                scales: { yAxes: [{ ticks: { beginAtZero: true, stepSize: 1 } }] },
                legend: { display: false }
            }
        });
    });
</script>
@endpush