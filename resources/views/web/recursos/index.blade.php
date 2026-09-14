@extends('layouts.web')

@section('title', 'Recursos Digitales y Enlaces - ' . $region->name)

@section('content')
<div class="content-header bg-light mb-4 py-4 border-bottom">
    <div class="container">
        <h1 class="m-0 text-dark">Recursos Digitales y Enlaces Útiles</h1>
        <p class="text-muted mb-0">Guías, tutoriales y portales de interés ciudadano para la Región {{ $region->name }}</p>
    </div>
</div>

<div class="container mb-5">
    <!-- Sección Guías y Tutoriales -->
    <h3 class="font-weight-bold text-primary mb-3"><i class="fas fa-file-download mr-2"></i>Guías y Materiales de Aprendizaje</h3>
    <div class="row mb-5">
        @forelse($resources as $resource)
            <div class="col-md-4 mb-3">
                <div class="card h-100 shadow-sm border">
                    <div class="card-body">
                        <span class="badge badge-info mb-2">{{ $resource->category }}</span>
                        <h5 class="card-title font-weight-bold text-dark w-100 mb-2">{{ $resource->title }}</h5>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        @if($resource->file_path)
                            <a href="{{ asset('storage/' . $resource->file_path) }}" target="_blank" class="btn btn-outline-primary btn-sm btn-block">
                                <i class="fas fa-download mr-1"></i> Descargar Archivo
                            </a>
                        @elseif($resource->external_url)
                            <a href="{{ $resource->external_url }}" target="_blank" class="btn btn-outline-secondary btn-sm btn-block">
                                <i class="fas fa-external-link-alt mr-1"></i> Ver Recurso Web
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-muted"><p>No hay recursos educativos cargados por el momento.</p></div>
        @endforelse
    </div>

    <!-- Sección Directoria de Enlaces Estado / Entidades -->
    <h3 class="font-weight-bold text-dark mb-3"><i class="fas fa-globe mr-2"></i>Directorio de Enlaces Institucionales</h3>
    <div class="row">
        @foreach($externalLinks as $category => $links)
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-light font-weight-bold">
                        CATEGORÍA: {{ $category }}
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach($links as $link)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ $link->title }}</span>
                                <a href="{{ $link->url }}" target="_blank" class="btn btn-sm btn-link text-primary">
                                    Visitar <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection