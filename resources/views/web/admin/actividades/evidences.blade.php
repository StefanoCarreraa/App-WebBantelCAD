@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Evidencias Fotográficas: {{ $activity->title }}</h2>
        <a href="{{ route('admin.actividades.index') }}" class="btn btn-secondary">Volver</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <!-- Formulario de Carga -->
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">Subir Fotografías</div>
                <div class="card-body">
                    <form action="{{ route('admin.actividades.evidences.store', $activity) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Seleccionar Imágenes (múltiple)</label>
                            <input type="file" name="images[]" class="form-control" multiple accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label>Leyenda / Descripción corta (opcional)</label>
                            <input type="text" name="caption" class="form-control" placeholder="Ej. Participantes en taller">
                        </div>
                        <button type="submit" class="btn btn-success w-100"><i class="fas fa-upload"></i> Cargar Evidencias</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Galería de Evidencias Cargadas -->
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">Galería de Evidencias</div>
                <div class="card-body">
                    <div class="row">
                        @forelse($activity->evidences as $evidence)
                            <div class="col-md-4 mb-3">
                                <div class="card h-100">
                                    <img src="{{ asset('storage/' . $evidence->image_path) }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                                    <div class="card-body p-2 text-center">
                                        <small class="text-muted">{{ $evidence->caption ?? 'Sin descripción' }}</small>
                                        <form action="{{ route('admin.evidences.destroy', $evidence) }}" method="POST" class="mt-2" onsubmit="return confirm('¿Eliminar esta fotografía?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger w-100">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center text-muted py-4">No hay evidencias cargadas para esta actividad.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection