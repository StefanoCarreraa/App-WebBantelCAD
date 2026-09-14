<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Portal CAD / CAU PRONATEL</title>

    <!-- AdminLTE 3 / Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
            --accent-gold: #ffc107;
            --accent-hover: #e0a800;
        }

        body.login-page {
            background: var(--primary-gradient);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            position: relative;
            overflow-x: hidden;
        }

        /* Decoración de Fondo Dinámica */
        body.login-page::before {
            content: '';
            position: absolute;
            width: 450px;
            height: 450px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255, 193, 7, 0.15) 0%, rgba(255, 193, 7, 0) 70%);
            top: -100px;
            right: -100px;
            pointer-events: none;
        }

        body.login-page::after {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(13, 110, 253, 0.15) 0%, rgba(13, 110, 253, 0) 70%);
            bottom: -150px;
            left: -150px;
            pointer-events: none;
        }

        .login-box {
            width: 440px;
            z-index: 10;
        }

        /* Glassmorphism Card Style */
        .card-login-custom {
            border: none;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.35);
            overflow: hidden;
        }

        .brand-header-card {
            background: rgba(15, 32, 67, 0.03);
            padding: 2rem 1.5rem 1rem;
            text-align: center;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .brand-logos-wrapper {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            background: #ffffff;
            padding: 8px 18px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .brand-logo-img {
            max-height: 38px;
            width: auto;
            object-fit: contain;
        }

        /* Form Input Enhancements */
        .custom-input-group {
            position: relative;
        }

        .custom-input-group .form-control {
            border-radius: 50px;
            padding-left: 45px;
            padding-right: 45px;
            height: 48px;
            font-size: 0.95rem;
            border: 1px solid #ced4da;
            transition: all 0.3s ease;
        }

        .custom-input-group .form-control:focus {
            border-color: #203a43;
            box-shadow: 0 0 0 0.2rem rgba(32, 58, 67, 0.15);
        }

        .input-icon-left {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            z-index: 5;
            font-size: 1.05rem;
            transition: color 0.3s ease;
        }

        .custom-input-group .form-control:focus + .input-icon-left,
        .custom-input-group:focus-within .input-icon-left {
            color: #0f2027;
        }

        .toggle-password-btn {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6c757d;
            cursor: pointer;
            z-index: 5;
            font-size: 1rem;
        }

        .toggle-password-btn:hover {
            color: #0f2027;
        }

        /* Botón Iniciar Sesión */
        .btn-login-submit {
            background: linear-gradient(135deg, #0f2027 0%, #203a43 100%);
            color: #ffffff;
            border: none;
            border-radius: 50px;
            height: 48px;
            font-weight: 700;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 6px 18px rgba(15, 32, 67, 0.25);
        }

        .btn-login-submit:hover {
            background: linear-gradient(135deg, #203a43 0%, #2c5364 100%);
            color: var(--accent-gold);
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(15, 32, 67, 0.35);
        }

        /* Custom Checkbox */
        .custom-control-input:checked ~ .custom-control-label::before {
            background-color: #0f2027;
            border-color: #0f2027;
        }

        /* Estilo Link Olvidé Contraseña */
        .forgot-link {
            color: #495057;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .forgot-link:hover {
            color: #0f2027;
            text-decoration: underline;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box animate__animated animate__fadeInDown">

        <div class="card card-login-custom">
            <!-- Logos Oficiales Institucionales -->
            <div class="brand-header-card">
                <div class="brand-logos-wrapper mb-2">
                    <img src="https://www.arequipabandaanchapronatel.pe/_next/image?url=%2Fbandaancha_logo_trim.png&w=1920&q=75"
                        alt="Banda Ancha" class="brand-logo-img">
                    <div style="border-left: 2px solid #ddd; height: 28px;"></div>
                    <img src="https://www.arequipabandaanchapronatel.pe/_next/image?url=%2FLogo_Pronatel_trim.png&w=640&q=75"
                        alt="PRONATEL" class="brand-logo-img">
                </div>
                <h5 class="font-weight-bold text-dark mt-2 mb-0" style="font-size: 1.15rem;">Acceso Administrativo</h5>
                <p class="text-muted small mb-0">Sistema de Gestión de Centros CAD & CAU</p>
            </div>

            <div class="card-body p-4">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Campo Correo Electrónico -->
                    <div class="form-group mb-4">
                        <label for="email" class="small font-weight-bold text-muted mb-1">
                            Correo Electrónico
                        </label>
                        <div class="custom-input-group">
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus
                                placeholder="nombre@ejemplo.com">
                            <i class="fas fa-envelope input-icon-left"></i>
                        </div>
                        @error('email')
                            <span class="text-danger small font-weight-bold d-block mt-1">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Campo Contraseña -->
                    <div class="form-group mb-3">
                        <label for="password" class="small font-weight-bold text-muted mb-1">
                            Contraseña
                        </label>
                        <div class="custom-input-group">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password" placeholder="••••••••">
                            <i class="fas fa-lock input-icon-left"></i>
                            <button type="button" class="toggle-password-btn" id="togglePasswordBtn" tabindex="-1">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="text-danger small font-weight-bold d-block mt-1">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Recordarme & Olvidé Contraseña -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="remember" name="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label small font-weight-bold text-secondary" for="remember">
                                Recordar sesión
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="forgot-link small" href="{{ route('password.request') }}">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif
                    </div>

                    <!-- Botón de Envío -->
                    <button type="submit" class="btn btn-login-submit btn-block font-weight-bold mb-3">
                        <i class="fas fa-sign-in-alt mr-2"></i> Iniciar Sesión
                    </button>

                    <!-- Botón Regresar al Portal Público -->
                    <a href="{{ url('/') }}" class="btn btn-outline-secondary btn-block rounded-pill btn-sm font-weight-bold">
                        <i class="fas fa-arrow-left mr-1"></i> Regresar al Portal Público
                    </a>
                </form>
            </div>

            <!-- Footer Institucional del Card -->
            <div class="card-footer bg-light text-center py-3 border-top-0">
                <p class="small text-muted mb-0">
                    &copy; {{ date('Y') }} <strong>BANDTEL S.A.C.</strong> | PRONATEL
                </p>
            </div>
        </div>

    </div>

    <!-- Scripts JQuery, Bootstrap y AdminLTE -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    <!-- Script Interactivo para Mostrar/Ocultar Contraseña -->
    <script>
        $(document).ready(function () {
            $('#togglePasswordBtn').on('click', function () {
                const passwordInput = $('#password');
                const toggleIcon = $('#toggleIcon');

                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    toggleIcon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordInput.attr('type', 'password');
                    toggleIcon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });
        });
    </script>
</body>

</html>