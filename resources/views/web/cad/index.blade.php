@extends('layouts.web')

@section('title', 'Directorio de Centros - ' . $region->name)

@section('content')
    <style>
        /* Estilos personalizados para el directorio */
        .page-header-banner {
            background: linear-gradient(135deg, rgba(15, 32, 67, 0.9) 0%, rgba(32, 58, 67, 0.85) 100%),
                url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1500&q=80') center/cover no-repeat;
            padding: 3.5rem 0;
        }

        .stat-box-card {
            border: none;
            border-radius: 12px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-box-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        }

        .center-card {
            border: none;
            border-radius: 15px;
            transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
            background: #ffffff;
        }

        .center-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1) !important;
        }

        .search-panel {
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .map-container-card {
            border-radius: 15px;
            overflow: hidden;
            border: none;
        }

        /* Corrección de SVG de Paginación */
        .pagination svg {
            max-width: 1rem !important;
            max-height: 1rem !important;
        }

        .pagination .page-item .page-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 38px;
            height: 38px;
            padding: 0.5rem 0.75rem;
        }
    </style>

    <!-- Banner Encabezado -->
    <div class="page-header-banner text-white mb-5">
        <div class="container text-center py-2" data-aos="fade-down">
            <span class="badge badge-warning text-uppercase px-3 py-2 mb-2 font-weight-bold shadow-sm"
                style="letter-spacing: 1px;">
                Geolocalización & Cobertura
            </span>
            <h1 class="display-4 font-weight-bold mb-2">Centros CAD y CAU</h1>
            <p class="lead text-light mb-0" style="font-size: 1.15rem;">
                Ubica los puntos de acceso digital y atención en la Región <strong
                    class="text-warning">{{ $region->name }}</strong>
            </p>
        </div>
    </div>

    <div class="container">
        <!-- 1. Tarjetas de Cifras Destacadas -->
        <div class="row mb-5 text-center">
            <div class="col-md-3 col-6 mb-3" data-aos="fade-up" data-aos-delay="100">
                <div class="card stat-box-card shadow-sm bg-white p-3 border-top border-info"
                    style="border-top-width: 4px !important;">
                    <div class="card-body p-2">
                        <div class="text-info mb-2"><i class="fas fa-map-marked-alt fa-2x"></i></div>
                        <h2 class="display-4 font-weight-bold text-dark mb-0">{{ $stats['total'] }}</h2>
                        <span class="text-muted font-weight-bold small text-uppercase">Total Centros</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-3" data-aos="fade-up" data-aos-delay="200">
                <div class="card stat-box-card shadow-sm bg-white p-3 border-top border-success"
                    style="border-top-width: 4px !important;">
                    <div class="card-body p-2">
                        <div class="text-success mb-2"><i class="fas fa-desktop fa-2x"></i></div>
                        <h2 class="display-4 font-weight-bold text-dark mb-0">{{ $stats['cad_a'] }}</h2>
                        <span class="text-muted font-weight-bold small text-uppercase">CAD Tipo A</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-3" data-aos="fade-up" data-aos-delay="300">
                <div class="card stat-box-card shadow-sm bg-white p-3 border-top border-warning"
                    style="border-top-width: 4px !important;">
                    <div class="card-body p-2">
                        <div class="text-warning mb-2"><i class="fas fa-laptop fa-2x"></i></div>
                        <h2 class="display-4 font-weight-bold text-dark mb-0">{{ $stats['cad_b'] }}</h2>
                        <span class="text-muted font-weight-bold small text-uppercase">CAD Tipo B</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-3" data-aos="fade-up" data-aos-delay="400">
                <div class="card stat-box-card shadow-sm bg-white p-3 border-top border-danger"
                    style="border-top-width: 4px !important;">
                    <div class="card-body p-2">
                        <div class="text-danger mb-2"><i class="fas fa-headset fa-2x"></i></div>
                        <h2 class="display-4 font-weight-bold text-dark mb-0">{{ $stats['cau'] }}</h2>
                        <span class="text-muted font-weight-bold small text-uppercase">Centros CAU</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Buscador y Filtros -->
        <div class="card search-panel bg-white p-3 mb-5" data-aos="zoom-in">
            <div class="card-body p-2">
                <form action="{{ route('cad.index', ['region' => $region->slug]) }}" method="GET"
                    class="form-row align-items-end">
                    <div class="col-md-4 mb-2 mb-md-0">
                        <label class="small font-weight-bold text-muted mb-1"><i class="fas fa-search mr-1"></i> Búsqueda
                            por Texto</label>
                        <input type="text" name="search" class="form-control rounded-pill"
                            placeholder="Código, nombre o localidad..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3 mb-2 mb-md-0">
                        <label class="small font-weight-bold text-muted mb-1"><i class="fas fa-filter mr-1"></i> Tipo de
                            Centro</label>
                        <select name="type" class="form-control custom-select rounded-pill">
                            <option value="">-- Todos los Tipos --</option>
                            <option value="CAD_A" {{ request('type') == 'CAD_A' ? 'selected' : '' }}>CAD Tipo A</option>
                            <option value="CAD_B" {{ request('type') == 'CAD_B' ? 'selected' : '' }}>CAD Tipo B</option>
                            <option value="CAU" {{ request('type') == 'CAU' ? 'selected' : '' }}>CAU (Atención al Usuario)</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-2 mb-md-0">
                        <label class="small font-weight-bold text-muted mb-1"><i class="fas fa-map-marker-alt mr-1"></i>
                            Provincia</label>
                        <select name="province" class="form-control custom-select rounded-pill">
                            <option value="">-- Todas las Provincias --</option>
                            @foreach ($provinces as $prov)
                                <option value="{{ $prov }}" {{ request('province') == $prov ? 'selected' : '' }}>
                                    {{ $prov }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-block rounded-pill font-weight-bold shadow-sm">
                            <i class="fas fa-search mr-1"></i> Filtrar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- 3. Mapa Interactivo Georreferenciado -->
        <div class="card map-container-card shadow-sm mb-5" data-aos="fade-up">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center py-3">
                <h5 class="card-title font-weight-bold mb-0">
                    <i class="fas fa-map-marked-alt text-warning mr-2"></i> Mapa Geolocalizado de Centros
                </h5>
                <span class="badge badge-light px-3 py-1 font-weight-normal">Región {{ $region->name }}</span>
            </div>
            <div class="card-body p-0">
                <div id="map" style="height: 480px; width: 100%;"></div>
            </div>
        </div>

        <!-- 4. Grilla de Resultados -->
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2" data-aos="fade-right">
            <h4 class="font-weight-bold text-dark mb-0"><i class="fas fa-list-ul text-primary mr-2"></i> Directorio de
                Centros</h4>
            <small class="text-muted">Mostrando resultados para {{ $region->name }}</small>
        </div>

        <div class="row mb-4">
            @forelse($centers as $center)
                <div class="col-md-6 col-lg-4 mb-4" data-aos="zoom-in-up"
                    data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                    <div class="card h-100 shadow-sm center-card">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="badge badge-dark px-2 py-1">{{ $center->code }}</span>
                                    <span
                                        class="badge badge-{{ $center->type == 'CAU' ? 'danger' : ($center->type == 'CAD_A' ? 'success' : 'warning') }} px-2 py-1 font-weight-bold">
                                        {{ str_replace('_', ' ', $center->type) }}
                                    </span>
                                </div>
                                <h5 class="card-title font-weight-bold text-dark w-100 mb-2" style="font-size: 1.1rem;">
                                    {{ $center->name }}</h5>

                                <p class="card-text text-muted small mb-1">
                                    <i class="fas fa-map-marker-alt text-danger mr-1"></i> <strong>Ubicación:</strong>
                                    {{ $center->province }} - {{ $center->district }}
                                </p>
                                <p class="card-text small text-secondary mb-0">
                                    <i class="fas fa-building text-primary mr-1"></i> <strong>Localidad:</strong>
                                    {{ $center->locality }}
                                </p>
                            </div>

                            <div class="mt-3 pt-3 border-top">
                                <a href="{{ route('cad.show', ['region' => $region->slug, 'code' => $center->code]) }}"
                                    class="btn btn-outline-primary btn-sm btn-block font-weight-bold rounded-pill">
                                    Ver Ficha Detallada <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 py-5 text-center text-muted bg-light rounded shadow-sm" data-aos="fade-in">
                    <i class="fas fa-search-location fa-4x text-muted mb-3"></i>
                    <h5 class="font-weight-bold">No se encontraron centros</h5>
                    <p class="mb-0">Prueba ajustando los filtros o el término de búsqueda.</p>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-4 mb-5" data-aos="fade-up">
            {{ $centers->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function initMap() {
            // Coordenadas centrales por defecto según la región
            var centerLat = {{ $region->slug == 'pasco' ? -10.58 : -9.93 }};
            var centerLng = {{ $region->slug == 'pasco' ? -75.8 : -76.24 }};

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 8,
                center: {
                    lat: centerLat,
                    lng: centerLng
                },
                styles: [{
                    "featureType": "administrative",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#444444"
                    }]
                }]
            });

            // Conversión del listado de centros a objeto JSON para los marcadores
            var centers = @json($centers->items());

            centers.forEach(function(center) {
                if (center.latitude && center.longitude) {
                    var markerColor = center.type === 'CAU' ? 'red' : (center.type === 'CAD_A' ? 'green' : 'blue');

                    var marker = new google.maps.Marker({
                        position: {
                            lat: parseFloat(center.latitude),
                            lng: parseFloat(center.longitude)
                        },
                        map: map,
                        title: center.name,
                        icon: 'https://maps.google.com/mapfiles/ms/icons/' + markerColor + '-dot.png'
                    });

                    var infoWindow = new google.maps.InfoWindow({
                        content: `
                        <div style="max-width:220px; padding: 6px;">
                            <strong style="display:block; font-size:14px;" class="text-dark mb-1">${center.name}</strong>
                            <span class="badge badge-dark mb-1">${center.code}</span><br>
                            <small class="text-muted">${center.district} - ${center.locality}</small><br>
                            <a href="/${'{{ $region->slug }}'}/centros/${center.code}" class="btn btn-sm btn-primary mt-2 text-white btn-block rounded-pill" style="font-size:11px; font-weight:bold;">Ver Ficha Completa</a>
                        </div>
                    `
                    });

                    marker.addListener('click', function() {
                        infoWindow.open(map, marker);
                    });
                }
            });
        }
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5yDqxNjDwGx-UYlY86gKqLGc9Si_thts&callback=initMap&loading=async">
    </script>
@endpush