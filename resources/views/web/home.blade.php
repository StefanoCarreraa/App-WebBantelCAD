@extends('layouts.web')

@section('title', 'Portal CAD - Región ' . $region->name)

@section('content')
    <style>
        .hero-animated {
            background: linear-gradient(135deg, rgba(15, 32, 67, 0.9) 0%, rgba(32, 58, 67, 0.85) 100%),
                url('https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=1500&q=80') center/cover no-repeat;
            padding: 5rem 0;
            position: relative;
            overflow: hidden;
        }

        .hero-title {
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }

        .card-hover-effect {
            border: none;
            border-radius: 15px;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .card-hover-effect:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12) !important;
        }

        .icon-box-animated {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            transition: all 0.3s ease;
        }

        .service-card:hover .icon-box-animated {
            transform: scale(1.1) rotate(5deg);
        }

        .activity-glass-card {
            border-radius: 12px;
            border-left: 5px solid #007bff;
            transition: all 0.3s ease;
        }

        .activity-glass-card:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 25px rgba(0, 123, 255, 0.15) !important;
        }

        /* Estilos Módulo Prevención de Sismos */
        .seismo-card {
            border: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            background: #fff;
        }

        .seismo-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .seismo-header-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }
    </style>

    <!-- Banner Principal Animado -->
    <div class="hero-animated text-white mb-5">
        <div class="container text-center py-4">
            <span
                class="badge badge-warning text-uppercase px-3 py-2 mb-3 font-weight-bold shadow-lg animate__animated animate__fadeInDown"
                style="letter-spacing: 1.5px;">
                <i class="fas fa-satellite-dish mr-1"></i> Conectividad e Inclusión Digital
            </span>
            <h1 class="display-4 font-weight-bold mb-3 hero-title animate__animated animate__fadeInUp">
                Conectividad, aprendizaje y oportunidades
            </h1>
            <p class="lead max-w-2xl mx-auto mb-4 text-light animate__animated animate__fadeInUp animate__delay-1s"
                style="font-size: 1.25rem;">
                Portal oficial de los Centros de Acceso Digital (CAD) en la Región <strong
                    class="text-warning">{{ $region->name }}</strong>
            </p>
            <div
                class="d-flex flex-wrap justify-content-center gap-3 mt-4 animate__animated animate__zoomIn animate__delay-1s">
                <a href="{{ route('cad.index', ['region' => $region->slug]) }}"
                    class="btn btn-warning btn-lg font-weight-bold shadow-lg m-2 px-4 rounded-pill">
                    <i class="fas fa-search-location mr-2"></i> Encuentra tu CAD
                </a>
                <a href="{{ route('agenda.index', ['region' => $region->slug]) }}"
                    class="btn btn-outline-light btn-lg font-weight-bold m-2 px-4 rounded-pill">
                    <i class="fas fa-calendar-alt mr-2"></i> Ver Actividades
                </a>
            </div>
        </div>
    </div>

    <div class="container">

        <!-- Tarjetas Cifras Destacadas -->
        <div class="row text-center mb-5">
            <div class="col-lg-3 col-sm-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card card-hover-effect shadow-sm bg-white p-3 border-top border-primary"
                    style="border-top-width: 5px !important;">
                    <div class="card-body p-2">
                        <div class="text-primary mb-2"><i class="fas fa-laptop-house fa-3x"></i></div>
                        <h2 class="display-4 font-weight-bold text-dark mb-0">{{ $stats['total_cad'] }}</h2>
                        <span class="text-muted font-weight-bold small text-uppercase">Total CAD Operativos</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card card-hover-effect shadow-sm bg-white p-3 border-top border-success"
                    style="border-top-width: 5px !important;">
                    <div class="card-body p-2">
                        <div class="text-success mb-2"><i class="fas fa-building fa-3x"></i></div>
                        <h2 class="display-4 font-weight-bold text-dark mb-0">{{ $stats['cad_a'] }}</h2>
                        <span class="text-muted font-weight-bold small text-uppercase">CAD Tipo A</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card card-hover-effect shadow-sm bg-white p-3 border-top border-warning"
                    style="border-top-width: 5px !important;">
                    <div class="card-body p-2">
                        <div class="text-warning mb-2"><i class="fas fa-store fa-3x"></i></div>
                        <h2 class="display-4 font-weight-bold text-dark mb-0">{{ $stats['cad_b'] }}</h2>
                        <span class="text-muted font-weight-bold small text-uppercase">CAD Tipo B</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="card card-hover-effect shadow-sm bg-white p-3 border-top border-danger"
                    style="border-top-width: 5px !important;">
                    <div class="card-body p-2">
                        <div class="text-danger mb-2"><i class="fas fa-headset fa-3x"></i></div>
                        <h2 class="display-4 font-weight-bold text-dark mb-0">{{ $stats['cau'] }}</h2>
                        <span class="text-muted font-weight-bold small text-uppercase">Centros CAU</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bloque de Servicios -->
        <div class="my-5 py-5 px-3 bg-light rounded-lg shadow-sm" data-aos="zoom-in">
            <div class="text-center mb-5">
                <h3 class="font-weight-bold text-dark">Servicios Gratuitos para la Comunidad</h3>
                <p class="text-muted">Aprovecha todas las oportunidades de inclusión digital que ofrecen los centros
                    CAD.</p>
            </div>
            <div class="row">
                <div class="col-md-4 text-center mb-4 service-card" data-aos="fade-right" data-aos-delay="100">
                    <div class="icon-box-animated bg-primary text-white mb-3 shadow"><i class="fas fa-wifi"></i></div>
                    <h5 class="font-weight-bold">Acceso a Internet Libre</h5>
                    <p class="text-muted small px-3">Conexión rápida para trámites públicos, tareas escolares e
                        investigación.</p>
                </div>
                <div class="col-md-4 text-center mb-4 service-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="icon-box-animated bg-success text-white mb-3 shadow"><i
                            class="fas fa-chalkboard-teacher"></i></div>
                    <h5 class="font-weight-bold">Capacitación Digital</h5>
                    <p class="text-muted small px-3">Talleres prácticos en herramientas tecnológicas para la comunidad.</p>
                </div>
                <div class="col-md-4 text-center mb-4 service-card" data-aos="fade-left" data-aos-delay="300">
                    <div class="icon-box-animated bg-warning text-white mb-3 shadow"><i class="fas fa-user-tie"></i></div>
                    <h5 class="font-weight-bold">Asesoría Personalizada</h5>
                    <p class="text-muted small px-3">Acompañamiento permanente por gestores digitales capacitados.</p>
                </div>
            </div>
        </div>

        <!-- Próximas Actividades -->
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3" data-aos="fade-right">
            <div>
                <h3 class="font-weight-bold text-dark mb-0"><i class="fas fa-calendar-check text-primary mr-2"></i>Próximas
                    Actividades</h3>
                <small class="text-muted">Talleres programados en los CAD de {{ $region->name }}</small>
            </div>
            <a href="{{ route('agenda.index', ['region' => $region->slug]) }}"
                class="btn btn-sm btn-outline-primary font-weight-bold px-3 rounded-pill">
                Ver Agenda Completa &rarr;
            </a>
        </div>

        <div class="row mb-5">
            @forelse($upcomingActivities as $activity)
                <div class="col-md-6 col-lg-3 mb-4" data-aos="flip-left" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="card h-100 shadow-sm border-0 activity-glass-card bg-white">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge badge-info text-truncate"
                                        style="max-width: 110px;">{{ $activity->category }}</span>
                                    <small class="text-success font-weight-bold"><i
                                            class="fas fa-circle small mr-1"></i>Programada</small>
                                </div>
                                <h5 class="card-title font-weight-bold text-dark mb-2" style="font-size: 1.05rem;">
                                    {{ $activity->title }}</h5>
                            </div>
                            <div class="mt-3 pt-2 border-top">
                                <p class="card-text text-muted small mb-1">
                                    <i class="far fa-clock text-primary mr-1"></i>
                                    {{ $activity->start_datetime->format('d/m/Y h:i A') }}
                                </p>
                                <p class="card-text text-secondary small mb-0 text-truncate">
                                    <i class="fas fa-map-marker-alt text-danger mr-1"></i> {{ $activity->center->name }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 py-5 text-center text-muted bg-light rounded shadow-sm" data-aos="fade-in">
                    <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                    <p class="mb-0 font-weight-bold">No hay actividades programadas próximamente en esta región.</p>
                </div>
            @endforelse
        </div>

        <!-- SECCIÓN COMPLETA DE PREVENCIÓN ANTE SISMOS -->
        <div class="my-5 py-4 border-top" id="prevencion-sismos" data-aos="fade-up">
            <div class="text-center mb-4">
                <span class="badge badge-danger text-uppercase px-3 py-2 mb-2 font-weight-bold">
                    <i class="fas fa-exclamation-triangle mr-1"></i> Seguridad Ciudadana
                </span>
                <h3 class="font-weight-bold text-dark">¿Qué hacer en caso de sismo?</h3>
                <p class="text-muted">Guía práctica de recomendaciones oficiales para la preparación y prevención de la
                    comunidad.</p>
            </div>

            <div class="row">
                <!-- ANTES -->
                <div class="col-md-4 mb-4" data-aos="fade-right" data-aos-delay="100">
                    <div class="card seismo-card shadow-sm h-100 p-3 border-top border-warning"
                        style="border-top-width: 4px !important;">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="seismo-header-icon bg-warning text-white mr-3"><i
                                        class="fas fa-clipboard-list"></i></div>
                                <h4 class="font-weight-bold text-dark mb-0">ANTES</h4>
                            </div>
                            <ul class="pl-3 text-secondary small mb-0">
                                <li class="mb-2">Elabora tu <strong>Plan Familiar de Emergencia</strong> con toda la
                                    comunidad.</li>
                                <li class="mb-2">Prepara la <strong>Mochila para Emergencias</strong> con suministros
                                    básicos.</li>
                                <li class="mb-2">Identifica las <strong>Zonas Seguras</strong> internas y externas y
                                    rutas de evacuación.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- DURANTE -->
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card seismo-card shadow-sm h-100 p-3 border-top border-danger"
                        style="border-top-width: 4px !important;">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="seismo-header-icon bg-danger text-white mr-3"><i class="fas fa-running"></i>
                                </div>
                                <h4 class="font-weight-bold text-dark mb-0">DURANTE</h4>
                            </div>
                            <ul class="pl-3 text-secondary small mb-0">
                                <li class="mb-2"><strong>Conserva la calma</strong> y transmite tranquilidad a las
                                    personas vulnerables.</li>
                                <li class="mb-2">Ubícate en la <strong>Zona Segura</strong> predeterminada de
                                    inmediato.</li>
                                <li class="mb-2"><strong>Aléjate de ventanas</strong>, repisas y objetos pesados que
                                    puedan caer.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- DESPUÉS -->
                <div class="col-md-4 mb-4" data-aos="fade-left" data-aos-delay="300">
                    <div class="card seismo-card shadow-sm h-100 p-3 border-top border-info"
                        style="border-top-width: 4px !important;">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="seismo-header-icon bg-info text-white mr-3"><i
                                        class="fas fa-house-damage"></i></div>
                                <h4 class="font-weight-bold text-dark mb-0">DESPUÉS</h4>
                            </div>
                            <ul class="pl-3 text-secondary small mb-0">
                                <li class="mb-2">Revisa si hay heridos o daños estructurales antes de reingresar.</li>
                                <li class="mb-2">Utiliza mensajes de texto (SMS) y evita saturar las líneas telefónicas.
                                </li>
                                <li class="mb-2">Sigue únicamente las indicaciones e información de <strong>canales
                                        oficiales</strong>.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Módulo e Información de INDECI con Logo Oficial -->
            <div class="card bg-dark text-white border-0 shadow-lg mt-3" data-aos="zoom-in">
                <div class="card-body p-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
                    <div class="d-flex align-items-center mb-3 mb-md-0">
                        <div class="bg-white p-2 rounded mr-3 shadow-sm d-flex align-items-center justify-content-center"
                            style="min-width: 120px; height: 50px;">
                            <img src="https://www.gob.pe/rails/active_storage/representations/proxy/eyJfcmFpbHMiOnsiZGF0YSI6MTM1NDgsInB1ciI6ImJsb2JfaWQifX0=--4e757c628a79366e4cfac532d38251df1912605d/eyJfcmFpbHMiOnsiZGF0YSI6eyJmb3JtYXQiOiJwbmciLCJyZXNpemVfdG9fbGltaXQiOltudWxsLDQ4XX0sInB1ciI6InZhcmlhdGlvbiJ9fQ==--830247c4bafe7cadca50817d8559bf1a09e3aa28/LOGO-INDECI.png"
                                alt="Logo Oficial INDECI" class="img-fluid"
                                style="max-height: 40px; object-fit: contain;">
                        </div>
                        <div>
                            <h5 class="font-weight-bold mb-1">Información Oficial de INDECI</h5>
                            <p class="mb-0 small text-white-50">Consulta recomendaciones, manuales completos y boletines
                                sísmicos actualizados del Instituto Nacional de Defensa Civil.</p>
                        </div>
                    </div>
                    <a href="https://www.gob.pe/indeci" target="_blank"
                        class="btn btn-outline-light font-weight-bold text-nowrap px-4 rounded-pill">
                        Visitar Portal INDECI <i class="fas fa-external-link-alt ml-1"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>
@endsection