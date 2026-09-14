<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portal CAD - PRONATEL')</title>

    <!-- Bootstrap 4 CSS / AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Animate.css & AOS (Animate On Scroll) -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background-color: #f8f9fa;
        }

        .bg-dark-blue {
            background: #0f2027 !important;
        }

        /* Header Logo Styling */
        .brand-logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255, 255, 255, 0.95);
            padding: 4px 12px;
            border-radius: 8px;
        }

        .brand-logo-img {
            max-height: 38px;
            width: auto;
            object-fit: contain;
        }

        /* Footer Styling */
        .footer-institutional {
            background: linear-gradient(180deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
            color: #eceff1;
            font-size: 0.9rem;
        }

        .footer-institutional a {
            color: #b0bec5;
            transition: all 0.3s ease;
        }

        .footer-institutional a:hover {
            color: #ffc107;
            text-decoration: none;
            padding-left: 4px;
        }

        .footer-logo-card {
            background: #ffffff;
            padding: 10px 15px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .social-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff !important;
            transition: all 0.3s ease;
        }

        .social-btn:hover {
            background: #ffc107;
            color: #000 !important;
            transform: translateY(-3px);
        }
    </style>

    <!-- Google Analytics (PRONATEL) -->
    @if (config('services.google.analytics_id'))
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google.analytics_id') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', '{{ config('services.google.analytics_id') }}');
        </script>
    @endif
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- HEADER / Navegación Principal Directa -->
        <nav class="main-header navbar navbar-expand-md navbar-dark bg-dark-blue border-0 shadow-sm sticky-top py-2">
            <div class="container">
                <!-- Logos Oficiales -->
                <a href="{{ route('inicio', ['region' => $region->slug ?? 'huanuco']) }}" class="navbar-brand py-0">
                    <div class="brand-logo-container">
                        <img src="https://www.arequipabandaanchapronatel.pe/_next/image?url=%2Fbandaancha_logo_trim.png&w=1920&q=75"
                            alt="Banda Ancha Logo" class="brand-logo-img">
                        <div style="border-left: 2px solid #ccc; height: 30px;"></div>
                        <img src="https://www.arequipabandaanchapronatel.pe/_next/image?url=%2FLogo_Pronatel_trim.png&w=640&q=75"
                            alt="PRONATEL Logo" class="brand-logo-img">
                    </div>
                </a>

                <button class="navbar-toggler p-0 border-0" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ml-auto font-weight-bold">
                        <li class="nav-item"><a href="{{ route('inicio', ['region' => $region->slug ?? 'huanuco']) }}"
                                class="nav-link text-white">Inicio</a></li>
                        <li class="nav-item"><a
                                href="{{ route('sobre.cad', ['region' => $region->slug ?? 'huanuco']) }}"
                                class="nav-link text-white">¿Qué es un CAD?</a></li>
                        <li class="nav-item"><a
                                href="{{ route('centros.index', ['region' => $region->slug ?? 'huanuco']) }}"
                                class="nav-link text-white">Centros CAD</a></li>
                        <li class="nav-item"><a
                                href="{{ route('agenda.index', ['region' => $region->slug ?? 'huanuco']) }}"
                                class="nav-link text-white">Agenda</a></li>
                        <li class="nav-item"><a
                                href="{{ route('cau.index', ['region' => $region->slug ?? 'huanuco']) }}"
                                class="nav-link text-white">CAU</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Contenido Central -->
        <div class="content-wrapper bg-white">
            @yield('content')
        </div>

        <!-- FOOTER / Pie de Página Institucional -->
        <footer class="footer-institutional pt-5 pb-3">
            <div class="container">
                <div class="row g-4 mb-4">
                    <!-- Columna 1: Branding y Logos Institucionales -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="footer-logo-card mb-3">
                            <img src="https://www.arequipabandaanchapronatel.pe/_next/image?url=%2Fbandaancha_logo_trim.png&w=1920&q=75"
                                alt="Banda Ancha" style="height: 38px; width: auto;">
                            <div style="border-left: 1px solid #ddd; height: 35px;"></div>
                            <img src="https://www.arequipabandaanchapronatel.pe/_next/image?url=%2FLogo_Pronatel_trim.png&w=640&q=75"
                                alt="PRONATEL" style="height: 38px; width: auto;">
                        </div>
                        <h6 class="font-weight-bold text-warning mb-2">Proyecto Regional de Banda Ancha</h6>
                        <p class="small text-muted mb-3">
                            Iniciativa promovida por el Programa Nacional de Telecomunicaciones (PRONATEL) y ejecutada
                            por BANDTEL S.A.C. para fomentar la conectividad e inclusión digital en comunidades rurales[cite: 1].
                        </p>
                        <div class="d-flex gap-2">
                            <a href="#" class="social-btn"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-btn"><i class="fab fa-youtube"></i></a>
                            <a href="#" class="social-btn"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>

                    <!-- Columna 2: Navegación Rápida -->
                    <div class="col-lg-2 col-md-6 mb-4">
                        <h6 class="font-weight-bold text-warning mb-3 border-bottom pb-2 border-secondary">Navegación
                        </h6>
                        <ul class="list-unstyled small">
                            <li class="mb-2"><a
                                    href="{{ route('inicio', ['region' => $region->slug ?? 'huanuco']) }}"><i
                                        class="fas fa-chevron-right small text-warning mr-1"></i> Inicio</a></li>
                            <li class="mb-2"><a
                                    href="{{ route('sobre.cad', ['region' => $region->slug ?? 'huanuco']) }}"><i
                                        class="fas fa-chevron-right small text-warning mr-1"></i> ¿Qué es un CAD?</a>
                            </li>
                            <li class="mb-2"><a
                                    href="{{ route('centros.index', ['region' => $region->slug ?? 'huanuco']) }}"><i
                                        class="fas fa-chevron-right small text-warning mr-1"></i> Directorio de CAD</a>
                            </li>
                            <li class="mb-2"><a
                                    href="{{ route('agenda.index', ['region' => $region->slug ?? 'huanuco']) }}"><i
                                        class="fas fa-chevron-right small text-warning mr-1"></i> Agenda Digital</a>
                            </li>
                            <li class="mb-2"><a
                                    href="{{ route('cau.index', ['region' => $region->slug ?? 'huanuco']) }}"><i
                                        class="fas fa-chevron-right small text-warning mr-1"></i> Centros CAU</a></li>
                        </ul>
                    </div>

                    <!-- Columna 3: Enlaces del Estado -->
                    <div class="col-lg-3 col-md-6 mb-4">
                        <h6 class="font-weight-bold text-warning mb-3 border-bottom pb-2 border-secondary">Enlaces del
                            Estado</h6>
                        <ul class="list-unstyled small">
                            <li class="mb-2"><a href="https://www.gob.pe" target="_blank"><i
                                        class="fas fa-external-link-alt mr-1"></i> Portal gob.pe</a></li>
                            <li class="mb-2"><a href="https://www.gob.pe/pronatel" target="_blank"><i
                                        class="fas fa-external-link-alt mr-1"></i> PRONATEL Oficial</a></li>
                            <li class="mb-2"><a href="https://www.gob.pe/mtc" target="_blank"><i
                                        class="fas fa-external-link-alt mr-1"></i> Ministerio de Transportes (MTC)</a>
                            </li>
                            <li class="mb-2"><a href="https://www.gob.pe/indeci" target="_blank"><i
                                        class="fas fa-shield-alt mr-1"></i> INDECI Oficial</a></li>
                        </ul>
                    </div>

                    <!-- Columna 4: Atención al Usuario -->
                    <div class="col-lg-3 col-md-6 mb-4">
                        <h6 class="font-weight-bold text-warning mb-3 border-bottom pb-2 border-secondary">Atención al
                            Usuario</h6>
                        <p class="small mb-1"><i class="fas fa-building text-warning mr-2"></i> Operador:
                            <strong>BANDTEL S.A.C.</strong>[cite: 1]</p>
                        <p class="small mb-1"><i class="fas fa-envelope text-warning mr-2"></i> contacto@bandtel.pe
                        </p>
                        <p class="small mb-1"><i class="fas fa-headset text-warning mr-2"></i> Soporte CAU
                            {{ $region->name ?? '' }}</p>
                        <div class="mt-3 p-2 bg-dark rounded border border-secondary text-center">
                            <small class="text-white-50"><i class="fas fa-chart-line text-success mr-1"></i>
                                Monitoreado por Google Analytics</small>
                        </div>
                    </div>
                </div>

                <hr class="border-secondary my-3">

                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-center small text-white-50">
                    <p class="mb-1 mb-md-0">&copy; {{ date('Y') }} Portal CAD - Región
                        {{ $region->name ?? 'Perú' }}. Todos los derechos reservados.</p>
                    <p class="mb-0">Proyecto Regional de Banda Ancha | PRONATEL | <span class="text-warning font-weight-bold">Desarrollo: Stefano Carrera</span></p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts JQuery & Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    <!-- Animaciones AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            easing: 'ease-out-cubic'
        });

        document.addEventListener('click', function(event) {
            const link = event.target.closest('.pagination a');
            if (!link) {
                return;
            }

            event.preventDefault();

            const content = document.querySelector('.content-wrapper');
            if (!content || link.dataset.loading === 'true') {
                return;
            }

            link.dataset.loading = 'true';
            content.style.opacity = '0.55';

            fetch(link.href, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('No se pudo cargar la siguiente página.');
                    }
                    return response.text();
                })
                .then(html => {
                    const page = new DOMParser().parseFromString(html, 'text/html');
                    const nextContent = page.querySelector('.content-wrapper');

                    if (!nextContent) {
                        throw new Error('La respuesta no contiene el listado solicitado.');
                    }

                    content.innerHTML = nextContent.innerHTML;
                    window.scrollTo({ top: content.offsetTop - 20, behavior: 'smooth' });
                })
                .catch(error => {
                    window.dispatchEvent(new CustomEvent('pagination:error', {
                        detail: error.message
                    }));
                })
                .finally(() => {
                    content.style.opacity = '';
                    link.dataset.loading = 'false';
                });
        });
    </script>
    @stack('scripts')
</body>

</html>