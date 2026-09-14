<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel de Administración - CAD / CAU')</title>

    <!-- AdminLTE 3 & FontAwesome 6 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Animate.css & AOS (Animate On Scroll) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --admin-dark: #0f2027;
            --admin-accent: #ffc107;
        }
        .main-sidebar {
            background: linear-gradient(180deg, #0f2027 0%, #203a43 50%, #2c5364 100%) !important;
        }
        .brand-link {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
        }
        .small-box {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .small-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        .card-custom:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }
        .table-valign-middle td, .table-valign-middle th {
            vertical-align: middle;
        }
    </style>
    @stack('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">

        <!-- 1. NAVBAR (Barra Superior) -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom shadow-sm">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('home', ['region' => 'pasco']) }}" target="_blank" class="nav-link font-weight-bold text-primary">
                        <i class="fas fa-globe mr-1"></i> Ver Portal Público (Pasco)
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('home', ['region' => 'huanuco']) }}" target="_blank" class="nav-link font-weight-bold text-info">
                        <i class="fas fa-globe mr-1"></i> Ver Portal Público (Huánuco)
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle font-weight-bold text-dark" data-toggle="dropdown" href="#">
                        <i class="fas fa-user-circle text-primary mr-1"></i> {{ Auth::user()->name ?? 'Administrador' }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow border-0 rounded-lg">
                        <div class="dropdown-header text-center font-weight-bold bg-light py-2">
                            {{ Auth::user()->email ?? 'admin@bantel.pe' }}
                        </div>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger font-weight-bold">
                                <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- 2. SIDEBAR GENERAL NAVEGABLE -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ route('admin.dashboard') }}" class="brand-link text-center py-3">
                <span class="brand-text font-weight-bold text-warning">Panel CAD / CAU</span>
            </a>

            <div class="sidebar">
                <nav class="mt-3">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>Dashboard Principal</p>
                            </a>
                        </li>

                        <li class="nav-header font-weight-bold text-uppercase text-light">GESTIÓN DE CONTENIDOS</li>

                        <li class="nav-item">
                            <a href="{{ route('admin.centers.index') }}" class="nav-link {{ request()->routeIs('admin.centers.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-building text-info"></i>
                                <p>Centros CAD / CAU</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.activities.index') }}" class="nav-link {{ request()->routeIs('admin.activities.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-calendar-alt text-success"></i>
                                <p>Agenda y Actividades</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.news.index') }}" class="nav-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-newspaper text-warning"></i>
                                <p>Noticias y Experiencias</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.resources.index') }}" class="nav-link {{ request()->routeIs('admin.resources.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-folder-open text-primary"></i>
                                <p>Recursos Digitales</p>
                            </a>
                        </li>

                        <li class="nav-header font-weight-bold text-uppercase text-light">CONFIGURACIÓN Y REPORTES</li>

                        <li class="nav-item">
                            <a href="{{ route('admin.external-links.index') }}" class="nav-link {{ request()->routeIs('admin.external-links.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-link text-info"></i>
                                <p>Enlaces de Interés</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.stats.index') }}" class="nav-link {{ request()->routeIs('admin.stats.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chart-bar text-warning"></i>
                                <p>Estadísticas y Visitas</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users-cog text-danger"></i>
                                <p>Usuarios y Roles</p>
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>

        <!-- 3. CONTENIDO DINÁMICO -->
        <div class="content-wrapper p-4">
            @yield('content')
        </div>

    </div>

    <!-- Scripts de JQuery, Bootstrap, AdminLTE y AOS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        $(document).ready(function() {
            AOS.init({ duration: 800, once: true });
        });
    </script>
    @stack('scripts')
</body>
</html>