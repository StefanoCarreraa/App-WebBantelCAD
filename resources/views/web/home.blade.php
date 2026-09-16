@extends('layouts.web')

@section('title', 'Portal CAD - Región ' . $region->name)

@section('content')
    <div class="home-page">
        <style>
            .home-page {
                --portal-navy: #0f2027;
                --portal-teal: #2c5364;
                --portal-teal-light: #557b87;
                --portal-gold: #f4c95d;
                --portal-gold-dark: #b98216;
                --portal-surface: #f2f6f7;
                --portal-ink: #24343b;
            }

            .home-page .text-primary {
                color: var(--portal-teal) !important;
            }

            .home-page .bg-primary {
                background-color: var(--portal-teal) !important;
            }

            .home-page .border-primary {
                border-color: var(--portal-teal) !important;
            }

            .home-page .btn-outline-primary {
                color: var(--portal-teal);
                border-color: var(--portal-teal);
            }

            .home-page .btn-outline-primary:hover,
            .home-page .btn-outline-primary:focus {
                color: #fff;
                background-color: var(--portal-teal);
                border-color: var(--portal-teal);
            }

            .home-page .btn-warning {
                color: #17262d;
                background: linear-gradient(135deg, #f9d976, #e9b83f);
                border-color: #e9b83f;
                box-shadow: 0 8px 18px rgba(233, 184, 63, .32);
            }

            .home-page .btn-warning:hover,
            .home-page .btn-warning:focus {
                color: #17262d;
                background: linear-gradient(135deg, #ffe69a, #f0c04c);
                border-color: #f0c04c;
                box-shadow: 0 10px 22px rgba(233, 184, 63, .42);
            }

            .home-page .text-warning {
                color: var(--portal-gold-dark) !important;
            }

            .home-page .hero-animated .text-warning,
            .home-page .hero-animated .badge-warning {
                color: #fff !important;
                background: linear-gradient(135deg, #f4c95d, #d99d24) !important;
                border: 1px solid rgba(255, 255, 255, .35);
                text-shadow: 0 1px 2px rgba(15, 32, 39, .35);
            }

            .home-page .bg-light {
                background-color: var(--portal-surface) !important;
            }

            .home-page h1,
            .home-page h2,
            .home-page h3,
            .home-page h4,
            .home-page h5 {
                color: var(--portal-ink);
            }

            .home-page .hero-animated h1,
            .home-page .hero-animated p,
            .home-page .hero-animated .text-light {
                color: #fff !important;
            }

            .home-page .hero-animated h1 {
                text-shadow: 0 3px 12px rgba(0, 0, 0, .6);
            }

            .home-page .hero-animated .btn-outline-light {
                color: #fff;
                border-width: 2px;
                border-color: rgba(255, 255, 255, .9);
                background: rgba(15, 32, 39, .2);
            }

            .home-page .hero-animated .btn-outline-light:hover,
            .home-page .hero-animated .btn-outline-light:focus {
                color: var(--portal-navy);
                background: #fff;
                border-color: #fff;
            }

            .hero-animated {
                background: linear-gradient(135deg, rgba(15, 32, 39, 0.96) 0%, rgba(44, 83, 100, 0.9) 100%),
                    url('https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=1500&q=80') center/cover no-repeat;
                padding: 4.5rem 0;
                position: relative;
                overflow: hidden;
            }

            .hero-title {
                text-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            }

            .hero-collage {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: .75rem;
                max-width: 860px;
                margin: 1.5rem auto 0;
            }

            .hero-collage img {
                width: 100%;
                height: 135px;
                object-fit: cover;
                border: 3px solid rgba(255, 255, 255, .75);
                border-radius: 12px;
                box-shadow: 0 8px 20px rgba(0, 0, 0, .25);
            }

            @media (max-width: 575.98px) {
                .hero-collage {
                    grid-template-columns: 1fr;
                }

                .hero-collage img {
                    height: 110px;
                }
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
                border-left: 5px solid var(--portal-teal);
                transition: all 0.3s ease;
            }

            .activity-glass-card:hover {
                transform: scale(1.02);
                box-shadow: 0 10px 25px rgba(44, 83, 100, 0.18) !important;
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

            .earthquake-infographic {
                position: relative;
                overflow: hidden;
                border-radius: 18px;
                background: linear-gradient(135deg, #fffaf0 0%, #f4f6f7 100%);
                border: 1px solid #e9ecef;
            }

            .earthquake-infographic::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 7px;
                background: linear-gradient(90deg, #ffc107 0 33.33%, #dc3545 33.33% 66.66%, #28a745 66.66%);
            }

            .infographic-step {
                position: relative;
                height: 100%;
                padding: 1.5rem;
                background: #fff;
                border-radius: 14px;
                border: 1px solid #edf0f2;
                box-shadow: 0 5px 16px rgba(15, 32, 39, .06);
            }

            .infographic-step-icon {
                width: 58px;
                height: 58px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                border-radius: 16px;
                color: #fff;
                font-size: 1.55rem;
                margin-bottom: 1rem;
            }

            .infographic-step.before .infographic-step-icon {
                background: #ffc107;
                color: #3d3010;
            }

            .infographic-step.during .infographic-step-icon {
                background: #dc3545;
            }

            .infographic-step.after .infographic-step-icon {
                background: #28a745;
            }

            .infographic-step ul {
                padding-left: 1.1rem;
                margin-bottom: 0;
            }

            .infographic-step li {
                margin-bottom: .65rem;
                color: #53656c;
                font-size: .92rem;
            }

            .infographic-step li:last-child {
                margin-bottom: 0;
            }

            .emergency-kit {
                background: #0f2027;
                color: #fff;
                border-radius: 14px;
                padding: 1.35rem 1.5rem;
            }

            .emergency-kit .kit-item {
                display: inline-flex;
                align-items: center;
                margin: .3rem .4rem .3rem 0;
                padding: .45rem .7rem;
                border-radius: 999px;
                background: rgba(255, 255, 255, .1);
                color: #f8f9fa;
                font-size: .84rem;
            }

            .emergency-kit .kit-item i {
                color: #ffc107;
                margin-right: .4rem;
            }

            .home-page .card {
                border-radius: 14px;
            }

            .home-page .card-header.bg-primary {
                background: linear-gradient(135deg, var(--portal-navy), var(--portal-teal)) !important;
            }

            .home-page .card-header.bg-primary h2,
            .home-page .card-header.bg-primary p {
                color: #fff !important;
            }

            .home-page .cad-b-card {
                border-top-color: #ffc107 !important;
            }

            .home-page .cad-b-icon {
                color: #ffc107 !important;
            }

            .home-page .indeci-card {
                background: linear-gradient(135deg, var(--portal-navy), var(--portal-teal)) !important;
            }

            .home-page .indeci-card h5 {
                color: #fff !important;
            }

            .home-page .indeci-card p {
                color: rgba(255, 255, 255, .82) !important;
            }

            .home-page .service-card p,
            .home-page .activity-glass-card p {
                color: #53656c !important;
            }
        </style>

        <!-- Bienvenida y frase institucional -->
        <div class="hero-animated text-white mb-5">
            <div class="container text-center py-4">
                <span
                    class="badge badge-warning text-uppercase px-3 py-2 mb-3 font-weight-bold shadow-lg animate__animated animate__fadeInDown"
                    style="letter-spacing: 1.5px;">
                    <i class="fas fa-satellite-dish mr-1"></i> Conectividad e Inclusión Digital
                </span>
                <h1 class="display-4 font-weight-bold mb-3 hero-title animate__animated animate__fadeInUp">
                    Bienvenidos al Portal Web de los Centros de Acceso Digital (CAD) de {{ $region->name }}
                </h1>
                <p class="lead max-w-2xl mx-auto mb-4 text-light animate__animated animate__fadeInUp animate__delay-1s"
                    style="font-size: 1.25rem;">
                    “Los Centros de Acceso Digital (CAD) fortalecerán las capacidades de los pobladores de las comunidades
                    rurales en tecnologías de información y comunicación”.
                </p>
                <div class="hero-collage" aria-label="Imágenes representativas de la región {{ $region->name }}">
                    <img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=600&q=80"
                        alt="Paisaje representativo de la región {{ $region->name }}">
                    <img src="https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?auto=format&fit=crop&w=600&q=80"
                        alt="Personas participando en una actividad de aprendizaje">
                    <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=600&q=80"
                        alt="Uso de tecnología y conectividad digital">
                </div>
                <div
                    class="d-flex flex-wrap justify-content-center gap-3 mt-4 animate__animated animate__zoomIn animate__delay-1s">
                    <a href="{{ route('centros.index', ['region' => $region->slug]) }}"
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

            @if ($region->slug === 'pasco')
                <!-- Proyecto de Internet de Banda Ancha -->
                <section class="card border-0 shadow-lg mb-5 overflow-hidden" data-aos="fade-up">
                    <div class="card-header bg-primary text-white p-4">
                        <h2 class="h3 font-weight-bold mb-1">Proyecto de Internet de Banda Ancha</h2>
                        <p class="mb-0">Creación de Banda Ancha para la Conectividad Integral y Desarrollo Social de la
                            región Pasco</p>
                    </div>
                    <div class="card-body p-4 p-lg-5">
                        <div class="row">
                            <div class="col-lg-7">
                                <h3 class="h5 font-weight-bold text-dark">¿Qué es el proyecto?</h3>
                                <p class="text-muted">
                                    Es una iniciativa promovida por el Estado peruano para mejorar la conectividad y el
                                    desarrollo rural y de interés social de Pasco. Las instituciones educativas, centros de
                                    salud y comisarías tendrán acceso a Internet de alta velocidad, y la población recibirá
                                    capacitación en alfabetización digital y tecnologías de la información y comunicación.
                                </p>
                                <h3 class="h5 font-weight-bold text-dark mt-4">¿Cuál es su objetivo?</h3>
                                <p class="text-muted">
                                    Brindar acceso a Internet e Intranet a 264 localidades, 376 instituciones educativas,
                                    155 centros de salud y 14 comisarías.
                                </p>
                                <p class="text-muted mb-0">
                                    El proyecto es financiado por PRONATEL, adscrito al MTC, y ejecutado por BANDTEL S.A.C.,
                                    que ha desplegado más de 1,021 kilómetros de fibra óptica en la región.
                                </p>
                            </div>
                            <div class="col-lg-5 mt-4 mt-lg-0">
                                <div class="bg-light rounded-lg p-4 h-100">
                                    <h3 class="h5 font-weight-bold text-primary">Beneficios para la comunidad</h3>
                                    <ul class="pl-3 text-muted mb-0">
                                        <li class="mb-2"><strong>Mejor comunicación:</strong> contacto con familiares e
                                            instituciones.</li>
                                        <li class="mb-2"><strong>Más oportunidades educativas:</strong> clases virtuales y
                                            recursos digitales.</li>
                                        <li class="mb-2"><strong>Desarrollo comunitario:</strong> trámites, servicios
                                            públicos y comercio electrónico.</li>
                                        <li class="mb-2"><strong>Internet gratuito:</strong> cobertura WiFi en plazas
                                            principales beneficiarias.</li>
                                        <li><strong>Capacidades digitales:</strong> formación para usar Internet y nuevas
                                            tecnologías.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif

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
                    <div class="card card-hover-effect shadow-sm bg-white p-3 border-top cad-b-card"
                        style="border-top-width: 5px !important;">
                        <div class="card-body p-2">
                            <div class="cad-b-icon mb-2"><i class="fas fa-store fa-3x"></i></div>
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
                        <p class="text-muted small px-3">Talleres prácticos en herramientas tecnológicas para la comunidad.
                        </p>
                    </div>
                    <div class="col-md-4 text-center mb-4 service-card" data-aos="fade-left" data-aos-delay="300">
                        <div class="icon-box-animated bg-warning text-white mb-3 shadow"><i class="fas fa-user-tie"></i>
                        </div>
                        <h5 class="font-weight-bold">Asesoría Personalizada</h5>
                        <p class="text-muted small px-3">Acompañamiento permanente por gestores digitales capacitados.</p>
                    </div>
                </div>
            </div>

            <!-- Próximas Actividades -->
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3" data-aos="fade-right">
                <div>
                    <h3 class="font-weight-bold text-dark mb-0"><i
                            class="fas fa-calendar-check text-primary mr-2"></i>Próximas
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
                    <div class="col-md-6 col-lg-3 mb-4" data-aos="flip-left"
                        data-aos-delay="{{ $loop->iteration * 100 }}">
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
                                        <i class="fas fa-map-marker-alt text-danger mr-1"></i>
                                        {{ $activity->center->name }}
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

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h4 class="h5 font-weight-bold text-dark">¿Qué es un sismo y por qué sucede?</h4>
                        <p class="text-muted mb-2">
                            Es un movimiento repentino del suelo causado por la liberación súbita de energía acumulada en la
                            tierra, generalmente por la fricción o el choque de placas tectónicas.
                        </p>
                        <p class="text-muted mb-0">
                            El Perú se encuentra en el “Círculo de Fuego del Océano Pacífico”, donde se concentra gran parte
                            de la actividad sísmica mundial.
                        </p>
                    </div>
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
                                    <li class="mb-2">Ubica zonas seguras y estructuras firmes.</li>
                                    <li class="mb-2">Prepara una mochila de emergencia.</li>
                                    <li class="mb-2">Participa en los simulacros de tu comunidad.</li>
                                    <li class="mb-2">Educa a los niños sobre medidas de precaución.</li>
                                    <li>Consulta con un especialista para reforzar tu vivienda.</li>
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
                                    <div class="seismo-header-icon bg-danger text-white mr-3"><i
                                            class="fas fa-running"></i>
                                    </div>
                                    <h4 class="font-weight-bold text-dark mb-0">DURANTE</h4>
                                </div>
                                <ul class="pl-3 text-secondary small mb-0">
                                    <li class="mb-2"><strong>Mantén la calma</strong> para reaccionar adecuadamente.</li>
                                    <li class="mb-2"><strong>Aléjate de ventanas</strong> y objetos con riesgo de caída.
                                    </li>
                                    <li class="mb-2">Busca un espacio seguro si no puedes salir rápidamente.</li>
                                    <li class="mb-2">Usa mensajes de texto para no saturar las líneas telefónicas.</li>
                                    <li>No utilices ascensores.</li>
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
                                    <li class="mb-2">Verifica que no existan fugas de gas.</li>
                                    <li class="mb-2">Comunícate con Bomberos (116), Cruz Roja ((01) 2660481) o SAMU
                                        (106).</li>
                                    <li class="mb-2">Auxilia a las personas heridas.</li>
                                    <li class="mb-2">Mantente alerta ante réplicas y aléjate de estructuras dañadas.</li>
                                    <li>En zonas costeras, aléjate del mar hasta descartar alerta de tsunami.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mt-2 mb-4">
                    <div class="card-body p-4">
                        <h4 class="h5 font-weight-bold text-dark"><i
                                class="fas fa-first-aid text-danger mr-2"></i>Contenido de la mochila de emergencia</h4>
                        <p class="text-muted mb-2">
                            Incluye alcohol, desinfectante, medicamentos, vendas, curitas, toallas, frazadas, agua
                            embotellada,
                            alimentos enlatados, linterna y radio a pilas.
                        </p>
                        <p class="text-muted mb-0">
                            Si en casa hay bebés o adultos mayores, agrega biberones, pañales, papillas o mantas según sus
                            necesidades.
                        </p>
                    </div>
                </div>

                <!-- Módulo e Información de INDECI con Logo Oficial -->
                <div class="card indeci-card text-white border-0 shadow-lg mt-3" data-aos="zoom-in">
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
                                <p class="mb-0 small text-white-50">Consulta recomendaciones, manuales completos y
                                    boletines
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
    </div>
@endsection
