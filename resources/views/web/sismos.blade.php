@extends('layouts.web')

@section('title', 'Prevención de Sismos - Región ' . $region->name)

@section('content')
<div class="content-header bg-danger text-white mb-4 py-4 border-bottom">
    <div class="container d-flex align-items-center">
        <i class="fas fa-exclamation-triangle fa-3x mr-3"></i>
        <div>
            <h1 class="m-0 font-weight-bold">¿Qué hacer en caso de sismo?</h1>
            <p class="mb-0">Medidas de prevención y seguridad para los ciudadanos de {{ $region->name }}</p>
        </div>
    </div>
</div>

<div class="container mb-5">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-info shadow-sm">
                <div class="card-header bg-info text-white font-weight-bold text-center">
                    <i class="fas fa-clipboard-check fa-2x mb-2 d-block"></i> ANTES
                </div>
                <div class="card-body bg-light">
                    <ul class="mb-0 text-muted">
                        <li class="mb-2">Ubica las zonas seguras y rutas de evacuación en tu CAD, hogar o centro de trabajo.</li>
                        <li class="mb-2">Prepara tu Mochila para Emergencias con agua, alimentos no perecibles, botiquín y linterna.</li>
                        <li>Participa activamente en los simulacros programados.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 border-warning shadow-sm">
                <div class="card-header bg-warning text-dark font-weight-bold text-center">
                    <i class="fas fa-hands-helping fa-2x mb-2 d-block"></i> DURANTE
                </div>
                <div class="card-body bg-light">
                    <ul class="mb-0 text-muted">
                        <li class="mb-2">Mantén la calma. El pánico genera accidentes.</li>
                        <li class="mb-2">Aléjate de ventanas, repisas o muebles pesados que puedan caer.</li>
                        <li>Si no puedes evacuar rápidamente, ubícate en la Zona de Seguridad Interna previamente identificada.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 border-success shadow-sm">
                <div class="card-header bg-success text-white font-weight-bold text-center">
                    <i class="fas fa-first-aid fa-2x mb-2 d-block"></i> DESPUÉS
                </div>
                <div class="card-body bg-light">
                    <ul class="mb-0 text-muted">
                        <li class="mb-2">Verifica si estás golpeado y ayuda a los heridos si tienes conocimientos de primeros auxilios.</li>
                        <li class="mb-2">Comunícate por mensajes de texto (SMS) y usa la línea 119 para emergencias.</li>
                        <li>Aléjate de cables eléctricos caídos y estructuras dañadas.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Enlace Directo a INDECI -->
    <div class="card shadow-sm border-0 bg-light mt-2">
        <div class="card-body text-center p-4">
            <img src="https://www.indeci.gob.pe/wp-content/uploads/2018/09/indeci-logo.png" alt="INDECI" style="max-height: 60px;" class="mb-3">
            <h5 class="font-weight-bold text-dark">Instituto Nacional de Defensa Civil</h5>
            <p class="text-muted">Mantente informado a través de los canales oficiales del Estado Peruano y prepárate ante cualquier eventualidad.</p>
            <a href="https://www.gob.pe/indeci" target="_blank" class="btn btn-danger btn-lg font-weight-bold shadow-sm">
                <i class="fas fa-external-link-alt mr-2"></i> Ir al Portal Oficial de INDECI
            </a>
        </div>
    </div>
</div>
@endsection