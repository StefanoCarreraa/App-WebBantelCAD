@extends('layouts.web')

@section('title', 'Centros de Atención al Usuario (CAU) - ' . $region->name)

@section('content')
<style>
    /* Estilos para el Hero Banner */
    .cau-hero {
        background: linear-gradient(135deg, rgba(80, 15, 25, 0.92) 0%, rgba(32, 58, 67, 0.88) 100%), 
                    url('https://images.unsplash.com/photo-1534536281715-e28d76741772?auto=format&fit=crop&w=1500&q=80') center/cover no-repeat;
        padding: 4.5rem 0;
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

    .cau-card {
        border: none;
        border-radius: 16px;
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        background: #ffffff;
        overflow: hidden;
    }

    .cau-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12) !important;
    }

    .icon-cau-box {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    /* Reglas para evitar desbordamiento visual de texto */
    .cau-info-row {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        padding: 0.6rem 0;
        border-bottom: 1px solid #f1f3f5;
        gap: 12px;
    }

    .cau-info-row:last-child {
        border-bottom: none;
    }

    .cau-info-label {
        font-size: 0.85rem;
        color: #6c757d;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .cau-info-value {
        font-size: 0.88rem;
        font-weight: 700;
        color: #212529;
        text-align: right;
        word-break: break-word;
        overflow-wrap: anywhere;
    }
</style>

<!-- 1. Banner Principal -->
<div class="cau-hero text-white mb-4">
    <div class="container text-center py-3" data-aos="fade-down">
        <span class="badge badge-danger text-uppercase px-3 py-2 mb-3 font-weight-bold shadow-sm" style="letter-spacing: 1px;">
            Atención Presencial al Ciudadano
        </span>
        <h1 class="display-4 font-weight-bold mb-2">Centros de Atención al Usuario (CAU)</h1>
        <p class="lead max-w-2xl mx-auto mb-0 text-light" style="font-size: 1.15rem;">
            Puntos institucionales de información, soporte y recepción de consultas sobre el servicio en la Región <strong class="text-warning">{{ $region->name }}</strong>.
        </p>
    </div>
</div>

<div class="container mb-5">

    <!-- 2. Bloques Informativos de Servicio -->
    <div class="row mb-5" data-aos="fade-up">
        <div class="col-md-4 mb-3">
            <div class="card h-100 border-0 shadow-sm p-3 rounded-lg bg-white">
                <div class="d-flex align-items-center">
                    <div class="icon-cau-box bg-danger text-white mr-3 shadow-sm">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div>
                        <h6 class="font-weight-bold text-dark mb-1">Orientación Directa</h6>
                        <p class="text-muted small mb-0">Atención personalizada sobre los servicios de conectividad.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card h-100 border-0 shadow-sm p-3 rounded-lg bg-white">
                <div class="d-flex align-items-center">
                    <div class="icon-cau-box bg-warning text-dark mr-3 shadow-sm">
                        <i class="fas fa-file-invoice"></i>
                    </div>
                    <div>
                        <h6 class="font-weight-bold text-dark mb-1">Consultas e Incidencias</h6>
                        <p class="text-muted small mb-0">Canal presencial oficial para reportes y trámites del ciudadano.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card h-100 border-0 shadow-sm p-3 rounded-lg bg-white">
                <div class="d-flex align-items-center">
                    <div class="icon-cau-box bg-info text-white mr-3 shadow-sm">
                        <i class="fas fa-building"></i>
                    </div>
                    <div>
                        <h6 class="font-weight-bold text-dark mb-1">Respaldado por BANDTEL</h6>
                        <p class="text-muted small mb-0">Gestión garantizada bajo la supervisión de PRONATEL.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Panel de Filtros y Búsqueda -->
    <div class="card filter-panel p-3 mb-5" data-aos="zoom-in">
        <div class="card-body p-2">
            <form action="{{ route('cau.index', ['region' => $region->slug]) }}" method="GET" class="form-row align-items-end">
                <div class="col-md-6 mb-2 mb-md-0">
                    <label class="small font-weight-bold text-muted mb-1">
                        <i class="fas fa-search mr-1 text-danger"></i> Búsqueda General
                    </label>
                    <input type="text" name="search" class="form-control rounded-pill" placeholder="Buscar por código, nombre o localidad..." value="{{ request('search') }}">
                </div>

                <div class="col-md-4 mb-2 mb-md-0">
                    <label class="small font-weight-bold text-muted mb-1">
                        <i class="fas fa-map-marker-alt mr-1 text-danger"></i> Provincia
                    </label>
                    <select name="province" class="form-control custom-select rounded-pill">
                        <option value="">-- Todas las Provincias --</option>
                        @foreach($provinces as $prov)
                            <option value="{{ $prov }}" {{ request('province') == $prov ? 'selected' : '' }}>{{ $prov }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-danger btn-block rounded-pill font-weight-bold shadow-sm">
                        <i class="fas fa-search mr-1"></i> Filtrar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 4. Grilla Ajustada de Centros CAU -->
    <div class="row">
        @forelse($caus as $cau)
            <div class="col-lg-6 mb-4" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 2) * 100 }}">
                <div class="card h-100 shadow-sm cau-card border-top border-danger" style="border-top-width: 5px !important;">
                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        <div>
                            <!-- Encabezado Tarjeta -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge badge-pill badge-danger px-3 py-2 font-weight-bold text-uppercase">
                                    <i class="fas fa-headset mr-1"></i> CAU Oficial
                                </span>
                                <span class="badge badge-pill badge-secondary px-3 py-2 font-weight-bold">
                                    {{ $cau->code }}
                                </span>
                            </div>

                            <h4 class="card-title font-weight-bold text-dark mb-3" style="font-size: 1.2rem; line-height: 1.3;">
                                {{ $cau->name }}
                            </h4>

                            <!-- Lista Estructurada Sin Desbordamiento -->
                            <div class="bg-light rounded p-3 mb-4">
                                <div class="cau-info-row">
                                    <span class="cau-info-label"><i class="fas fa-map-marked text-danger mr-1"></i> Provincia:</span>
                                    <span class="cau-info-value">{{ $cau->province }}</span>
                                </div>

                                <div class="cau-info-row">
                                    <span class="cau-info-label"><i class="fas fa-building text-primary mr-1"></i> Distrito / Loc.:</span>
                                    <span class="cau-info-value">{{ $cau->district }} - {{ $cau->locality }}</span>
                                </div>

                                <div class="cau-info-row">
                                    <span class="cau-info-label"><i class="fas fa-phone-alt text-success mr-1"></i> Tel. Atención:</span>
                                    <span class="cau-info-value">{{ $cau->phone ?? 'Mesa de partes presencial' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Botón GPS -->
                        <div>
                            @if($cau->latitude && $cau->longitude)
                                <a href="https://maps.google.com/?q={{ $cau->latitude }},{{ $cau->longitude }}" target="_blank" class="btn btn-outline-danger btn-block font-weight-bold rounded-pill">
                                    <i class="fas fa-directions mr-1"></i> Ver Ubicación GPS en Google Maps
                                </a>
                            @else
                                <button class="btn btn-light btn-block font-weight-bold rounded-pill text-muted" disabled>
                                    <i class="fas fa-map-marker-slash mr-1"></i> Ubicación no georreferenciada
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 py-5 text-center text-muted bg-light rounded-lg shadow-sm" data-aos="fade-in">
                <i class="fas fa-headset fa-4x text-muted mb-3"></i>
                <h5 class="font-weight-bold text-dark">No se encontraron Centros CAU</h5>
                <p class="mb-0">No hay oficinas de atención registradas para el criterio de búsqueda seleccionado en {{ $region->name }}.</p>
            </div>
        @endforelse
    </div>

    <!-- 5. Paginación -->
    @if(method_exists($caus, 'links'))
        <div class="d-flex justify-content-center mt-4 mb-5" data-aos="fade-up">
            {{ $caus->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>
    @endif

</div>
@endsection