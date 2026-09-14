@extends('layouts.web')

@section('title', $center->name . ' - Región ' . $region->name)

@section('content')
    <style>
        /* Estilos personalizados para la Ficha Detallada */
        .center-header-banner {
            background: linear-gradient(135deg, rgba(15, 32, 67, 0.92) 0%, rgba(32, 58, 67, 0.88) 100%),
                url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1500&q=80') center/cover no-repeat;
            padding: 3rem 0;
            border-bottom: 4px solid #ffc107;
        }

        .info-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-3px);
        }

        .activity-item {
            border-left: 4px solid #007bff;
            background: #f8f9fa;
            border-radius: 0 8px 8px 0;
            transition: all 0.3s ease;
        }

        .activity-item:hover {
            background: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transform: translateX(4px);
        }
    </style>

    <!-- Banner Encabezado -->
    <div class="center-header-banner text-white mb-5">
        <div class="container" data-aos="fade-down">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                <div class="mb-3 mb-md-0">
                    <div class="d-flex align-items-center mb-2">
                        <span class="badge badge-warning text-dark font-weight-bold px-3 py-1 mr-2 shadow-sm">
                            {{ $center->code }}
                        </span>
                        <span
                            class="badge badge-{{ $center->type == 'CAU' ? 'danger' : ($center->type == 'CAD_A' ? 'success' : 'info') }} px-3 py-1 font-weight-bold">
                            {{ str_replace('_', ' ', $center->type) }}
                        </span>
                    </div>
                    <h1 class="display-5 font-weight-bold mb-1">{{ $center->name }}</h1>
                    <p class="lead mb-0 text-light small">
                        <i class="fas fa-map-marker-alt text-danger mr-1"></i>
                        {{ $center->province }} &bull; {{ $center->district }} &bull; {{ $center->locality }}
                    </p>
                </div>
                <div>
                    <a href="{{ route('cad.index', ['region' => $region->slug]) }}"
                        class="btn btn-outline-light rounded-pill font-weight-bold px-4 shadow-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Volver al Directorio
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row">
            <!-- Columna Izquierda: Información del Centro, Ubicación y Gestor -->
            <div class="col-lg-4 col-md-5 mb-4">
                <!-- Tarjeta 1: Información General y Horario -->
                <div class="card info-card mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-header bg-dark text-white font-weight-bold border-0">
                        <i class="fas fa-info-circle text-warning mr-1"></i> Información del Centro
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <span class="text-muted"><i class="fas fa-flag text-primary mr-2"></i> Estado:</span>
                                <span
                                    class="badge badge-success px-3 py-1 font-weight-bold">{{ $center->status ?? 'OPERATIVO' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <span class="text-muted"><i class="fas fa-city text-primary mr-2"></i> Provincia:</span>
                                <strong class="text-dark">{{ $center->province }}</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <span class="text-muted"><i class="fas fa-map text-primary mr-2"></i> Distrito:</span>
                                <strong class="text-dark">{{ $center->district }}</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <span class="text-muted"><i class="fas fa-home text-primary mr-2"></i> Localidad:</span>
                                <strong class="text-dark">{{ $center->locality }}</strong>
                            </li>
                            <li class="list-group-item py-3">
                                <span class="text-muted d-block mb-1"><i class="fas fa-clock text-primary mr-2"></i> Horario
                                    de Atención:</span>
                                <small class="text-secondary font-weight-bold d-block bg-light p-2 rounded border">
                                    {{ $center->schedule ?? 'Lunes a Viernes: 08:00 AM - 05:00 PM' }}
                                </small>
                            </li>
                        </ul>
                    </div>
                    @if ($center->latitude && $center->longitude)
                        <div class="card-footer bg-white border-top-0 p-3">
                            <a href="https://maps.google.com/?q={{ $center->latitude }},{{ $center->longitude }}"
                                target="_blank" class="btn btn-primary btn-block rounded-pill font-weight-bold shadow-sm">
                                <i class="fas fa-directions mr-1"></i> Cómo Llegar (Google Maps)
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Tarjeta 2: Contacto y Gestor Digital -->
                <div class="card info-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-header bg-dark text-white font-weight-bold border-0">
                        <i class="fas fa-user-shield text-info mr-1"></i> Gestor y Contacto Directo
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <small class="text-muted text-uppercase font-weight-bold d-block mb-1">Gestor Digital /
                                Encargado</small>
                            <p class="font-weight-bold text-dark mb-0">{{ $center->manager_name ?? 'Por asignar' }}</p>
                        </div>
                        <div class="mb-3 border-top pt-2">
                            <small class="text-muted text-uppercase font-weight-bold d-block mb-1">Teléfono de
                                Contacto</small>
                            @if ($center->phone)
                                <a href="tel:{{ $center->phone }}" class="font-weight-bold text-primary">
                                    <i class="fas fa-phone-alt mr-1"></i> {{ $center->phone }}
                                </a>
                            @else
                                <span class="text-muted small">Sin número telefónico registrado</span>
                            @endif
                        </div>
                        <div class="mb-3 border-top pt-2">
                            <small class="text-muted text-uppercase font-weight-bold d-block mb-1">Correo
                                Electrónico</small>
                            @if ($center->email)
                                <a href="mailto:{{ $center->email }}" class="font-weight-bold text-primary text-break">
                                    <i class="fas fa-envelope mr-1"></i> {{ $center->email }}
                                </a>
                            @else
                                <span class="text-muted small">Sin correo electrónico registrado</span>
                            @endif
                        </div>

                        @if ($center->facebook_url)
                            <div class="border-top pt-3">
                                <a href="{{ $center->facebook_url }}" target="_blank"
                                    class="btn btn-outline-primary btn-block rounded-pill font-weight-bold btn-sm">
                                    <i class="fab fa-facebook-square mr-1"></i> Facebook Oficial del CAD
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Columna Derecha: Agenda de Actividades del Centro -->
            <div class="col-lg-8 col-md-7 mb-4">
                <div class="card info-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                        <h5 class="card-title font-weight-bold text-dark mb-0">
                            <i class="fas fa-calendar-alt text-primary mr-2"></i> Agenda de Actividades y Capacitaciones
                        </h5>
                        <span class="badge badge-light border px-2 py-1">{{ count($center->activities) }}
                            Registradas</span>
                    </div>
                    <div class="card-body">
                        @forelse($center->activities as $activity)
                            <div class="activity-item p-3 mb-3" data-aos="fade-left"
                                data-aos-delay="{{ ($loop->index % 4) * 100 }}">
                                <div
                                    class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center mb-2">
                                    <h6 class="font-weight-bold text-primary mb-1 mb-sm-0" style="font-size: 1.1rem;">
                                        {{ $activity->title }}
                                    </h6>
                                    <span class="badge badge-pill badge-primary px-3 py-1">
                                        <i class="far fa-clock mr-1"></i>
                                        {{ \Carbon\Carbon::parse($activity->start_datetime)->format('d/m/Y h:i A') }}
                                    </span>
                                </div>
                                <p class="text-secondary small mb-2">{{ $activity->description }}</p>
                                <div class="d-flex align-items-center text-muted small">
                                    <i class="fas fa-users text-info mr-1"></i>
                                    <strong>Público Objetivo:</strong>
                                    <span class="ml-1">{{ $activity->target_audience ?? 'Comunidad en general' }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5 text-muted bg-light rounded" data-aos="fade-in">
                                <i class="far fa-calendar-times fa-3x text-muted mb-3"></i>
                                <h6 class="font-weight-bold">No hay actividades programadas</h6>
                                <p class="small mb-0">Actualmente no se registran talleres o capacitaciones pendientes para
                                    este centro.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
