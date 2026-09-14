@extends('layouts.web')

@section('title', '¿Qué es un CAD? - ' . $region->name)

@section('content')
<style>
    /* Estilos personalizados para la vista ¿Qué es un CAD? */
    .about-hero {
        background: linear-gradient(135deg, rgba(15, 32, 67, 0.9) 0%, rgba(32, 58, 67, 0.85) 100%), 
                    url('https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=1500&q=80') center/cover no-repeat;
        padding: 5rem 0;
    }
    
    .card-benefit {
        border: none;
        border-radius: 15px;
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        background: #ffffff;
    }
    .card-benefit:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }

    .icon-benefit-box {
        width: 65px;
        height: 65px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        transition: all 0.3s ease;
    }
    .card-benefit:hover .icon-benefit-box {
        transform: scale(1.1) rotate(5deg);
    }

    .type-card {
        border: none;
        border-radius: 15px;
        transition: all 0.3s ease;
    }
    .type-card:hover {
        transform: translateY(-5px);
    }

    .accordion-custom .card-header {
        background-color: #ffffff;
        border-bottom: 1px solid #edf2f7;
    }
    .accordion-custom .btn-link {
        color: #0f2027;
        font-weight: 700;
        text-decoration: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }
</style>

<!-- 1. Hero Banner Principal -->
<div class="about-hero text-white mb-5">
    <div class="container text-center py-3" data-aos="fade-down">
        <span class="badge badge-warning text-uppercase px-3 py-2 mb-3 font-weight-bold shadow-sm" style="letter-spacing: 1px;">
            Inclusión Digital y Social
        </span>
        <h1 class="display-4 font-weight-bold mb-3">¿Qué es un Centro de Acceso Digital (CAD)?</h1>
        <p class="lead max-w-2xl mx-auto mb-0 text-light" style="font-size: 1.2rem;">
            Espacios públicos implementados para brindar acceso libre a Internet y promover competencias tecnológicas en la Región <strong class="text-warning">{{ $region->name }}</strong>.
        </p>
    </div>
</div>

<div class="container">

    <!-- 2. Introducción Conceptual e Impacto -->
    <div class="row align-items-center my-5 py-3">
        <div class="col-lg-7 mb-4 mb-lg-0" data-aos="fade-right">
            <span class="text-primary font-weight-bold text-uppercase small" style="letter-spacing: 1px;">Propósito Institucional</span>
            <h2 class="font-weight-bold text-dark mb-3">Tecnología al servicio del desarrollo comunitario</h2>
            <p class="text-secondary lead mb-3">
                Los Centros de Acceso Digital (CAD) son centros de acceso al público creados para brindar conectividad libre y promover el desarrollo de competencias digitales en localidades rurales y preferentes.
            </p>
            <p class="text-muted mb-4">
                En cada CAD, los ciudadanos pueden aprender a utilizar las Tecnologías de la Información y Comunicación (TIC), realizar trámites virtuales en plataformas del Estado (gob.pe), impulsar emprendimientos locales y recibir capacitación técnica continua con la orientación presencial de un gestor digital.
            </p>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('cad.index', ['region' => $region->slug]) }}" class="btn btn-primary font-weight-bold px-4 py-2 rounded-pill shadow-sm">
                    <i class="fas fa-search-location mr-2"></i> Buscar un CAD en {{ $region->name }}
                </a>
            </div>
        </div>

        <div class="col-lg-5" data-aos="zoom-in" data-aos-delay="200">
            <div class="card card-benefit shadow-lg p-4 text-center bg-white border-top border-primary" style="border-top-width: 5px !important;">
                <div class="card-body">
                    <div class="icon-benefit-box bg-primary text-white mb-3 shadow">
                        <i class="fas fa-laptop-house"></i>
                    </div>
                    <h4 class="font-weight-bold text-dark mb-2">Servicios 100% Gratuitos</h4>
                    <p class="text-muted small mb-0">
                        Equipamiento informático moderno, conexión rápida de banda ancha, aulas de taller y asesoramiento personalizado libre de costo para toda la comunidad.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Bloque de Beneficios Clave -->
    <div class="my-5 py-5 px-3 bg-light rounded-lg shadow-sm" data-aos="fade-up">
        <div class="text-center mb-5">
            <h3 class="font-weight-bold text-dark">Beneficios Generales del CAD</h3>
            <p class="text-muted">Aprovechamiento productivo de las tecnologías para estudiantes, emprendedores y familias.</p>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card card-benefit h-100 p-3 shadow-sm text-center">
                    <div class="card-body">
                        <div class="icon-benefit-box bg-primary text-white mb-3 shadow"><i class="fas fa-wifi"></i></div>
                        <h5 class="font-weight-bold text-dark">Acceso a Internet</h5>
                        <p class="text-muted small mb-0">Navegación libre de alta velocidad para investigaciones escolares, universitarias y consultas de trámites públicos.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card card-benefit h-100 p-3 shadow-sm text-center">
                    <div class="card-body">
                        <div class="icon-benefit-box bg-success text-white mb-3 shadow"><i class="fas fa-chalkboard-teacher"></i></div>
                        <h5 class="font-weight-bold text-dark">Capacitación Digital</h5>
                        <p class="text-muted small mb-0">Talleres prácticos sobre ofimática, alfabetización digital básica, herramientas digitales y habilidades informáticas.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card card-benefit h-100 p-3 shadow-sm text-center">
                    <div class="card-body">
                        <div class="icon-benefit-box bg-warning text-white mb-3 shadow"><i class="fas fa-user-tie"></i></div>
                        <h5 class="font-weight-bold text-dark">Asesoramiento Continuo</h5>
                        <p class="text-muted small mb-0">Acompañamiento permanente por parte de un gestor capacitado para orientarte en el uso seguro de tecnologías.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. Cuadro Comparativo: Tipos de Centros -->
    <div class="my-5" data-aos="fade-up">
        <div class="text-center mb-5">
            <span class="text-primary font-weight-bold text-uppercase small">Tipología Institucional</span>
            <h3 class="font-weight-bold text-dark">Tipos de Centros en la Región {{ $region->name }}</h3>
            <p class="text-muted">Conoce las características según la infraestructura y el nivel de atención.</p>
        </div>

        <div class="row">
            <!-- CAD TIPO A -->
            <div class="col-lg-4 col-md-6 mb-4" data-aos="flip-left" data-aos-delay="100">
                <div class="card type-card h-100 shadow-sm border-top border-success" style="border-top-width: 5px !important;">
                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-success text-white rounded-circle p-3 mr-3"><i class="fas fa-desktop fa-lg"></i></div>
                                <div>
                                    <h4 class="font-weight-bold mb-0 text-dark">CAD Tipo A</h4>
                                    <small class="text-muted">Alta Capacidad</small>
                                </div>
                            </div>
                            <p class="text-secondary small mb-3">
                                Ubicados estratégicamente en capitales provinciales o distritales de mayor densidad poblacional.
                            </p>
                            <ul class="pl-3 text-muted small mb-0">
                                <li class="mb-2">Mayor número de computadoras y tabletas.</li>
                                <li class="mb-2">Aulas de capacitación grupal amplias.</li>
                                <li class="mb-2">Soporte técnico y gestor digital permanente.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CAD TIPO B -->
            <div class="col-lg-4 col-md-6 mb-4" data-aos="flip-left" data-aos-delay="200">
                <div class="card type-card h-100 shadow-sm border-top border-warning" style="border-top-width: 5px !important;">
                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-warning text-dark rounded-circle p-3 mr-3"><i class="fas fa-laptop fa-lg"></i></div>
                                <div>
                                    <h4 class="font-weight-bold mb-0 text-dark">CAD Tipo B</h4>
                                    <small class="text-muted">Cobertura Rural</small>
                                </div>
                            </div>
                            <p class="text-secondary small mb-3">
                                Diseñados específicamente para centros poblados y comunidades rurales de la región.
                            </p>
                            <ul class="pl-3 text-muted small mb-0">
                                <li class="mb-2">Estaciones de trabajo de conectividad directa.</li>
                                <li class="mb-2">Talleres de alfabetización digital básica.</li>
                                <li class="mb-2">Acceso a internet e información del Estado.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CAU -->
            <div class="col-lg-4 col-md-12 mb-4" data-aos="flip-left" data-aos-delay="300">
                <div class="card type-card h-100 shadow-sm border-top border-danger" style="border-top-width: 5px !important;">
                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-danger text-white rounded-circle p-3 mr-3"><i class="fas fa-headset fa-lg"></i></div>
                                <div>
                                    <h4 class="font-weight-bold mb-0 text-dark">Atención (CAU)</h4>
                                    <small class="text-muted">Soporte al Usuario</small>
                                </div>
                            </div>
                            <p class="text-secondary small mb-3">
                                Puntos institucionales orientados a la atención presencial de consultas e incidencias del servicio.
                            </p>
                            <ul class="pl-3 text-muted small mb-0">
                                <li class="mb-2">Orientación directa al ciudadano.</li>
                                <li class="mb-2">Recepción de consultas sobre el proyecto de telecomunicaciones.</li>
                                <li class="mb-2">Canal oficial de BANDTEL y PRONATEL.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 5. Preguntas Frecuentes (FAQ) en Acordeón -->
    <div class="my-5 py-4 border-top" data-aos="fade-up">
        <div class="text-center mb-4">
            <h3 class="font-weight-bold text-dark">Preguntas Frecuentes</h3>
            <p class="text-muted">Resuelve tus dudas sobre el uso de las instalaciones y capacitaciones.</p>
        </div>

        <div class="accordion accordion-custom shadow-sm rounded-lg overflow-hidden" id="faqAccordion">
            <!-- FAQ 1 -->
            <div class="card border-0 mb-1">
                <div class="card-header p-0" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link p-3 text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <span><i class="fas fa-question-circle text-primary mr-2"></i> ¿Tengo que pagar algo por usar las computadoras o el Internet?</span>
                            <i class="fas fa-chevron-down text-muted"></i>
                        </button>
                    </h5>
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#faqAccordion">
                    <div class="card-body text-muted small bg-light">
                        No. Todos los servicios ofrecidos en los Centros de Acceso Digital (uso de computadoras, acceso a Internet, capacitaciones y orientación) son completamente gratuitos para la población de la región.
                    </div>
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="card border-0 mb-1">
                <div class="card-header p-0" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-link p-3 text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <span><i class="fas fa-question-circle text-primary mr-2"></i> ¿Quiénes pueden inscribirse en los talleres y capacitaciones?</span>
                            <i class="fas fa-chevron-down text-muted"></i>
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqAccordion">
                    <div class="card-body text-muted small bg-light">
                        Los talleres están abiertos para toda la comunidad: niños, jóvenes, adultos, adultos mayores, estudiantes y emprendedores locales. Puedes revisar la sección "Agenda" para consultar los horarios.
                    </div>
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="card border-0 mb-1">
                <div class="card-header p-0" id="headingThree">
                    <h5 class="mb-0">
                        <button class="btn btn-link p-3 text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <span><i class="fas fa-question-circle text-primary mr-2"></i> ¿Cuáles son los horarios de atención?</span>
                            <i class="fas fa-chevron-down text-muted"></i>
                        </button>
                    </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqAccordion">
                    <div class="card-body text-muted small bg-light">
                        Cada centro maneja su propio horario según la localidad. Te recomendamos buscar la ficha del CAD correspondiente en la sección "Centros CAD" para revisar los horarios detallados de atención.
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection