@extends('layouts.admin')

@section('title', 'Editar Actividad: ' . $activity->title)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
    <div>
        <h1 class="h3 font-weight-bold text-dark mb-1">
            <i class="fas fa-edit text-warning mr-2"></i>Editar Actividad: {{ $activity->title }}
        </h1>
        <p class="text-muted small mb-0">Actualice los datos o administre la galería de fotos</p>
    </div>
    <a href="{{ route('admin.activities.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill font-weight-bold">
        <i class="fas fa-arrow-left mr-1"></i> Volver al listado
    </a>
</div>

<div class="card card-outline card-warning shadow-sm rounded-lg" data-aos="fade-up">
    <form action="{{ route('admin.activities.update', $activity) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body p-4">
            <div class="row">
                <div class="col-md-8 form-group">
                    <label class="small font-weight-bold text-muted">Título de la Actividad <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control rounded-pill @error('title') is-invalid @enderror" value="{{ old('title', $activity->title) }}" required>
                    @error('title') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4 form-group">
                    <label class="small font-weight-bold text-muted">Centro Asociado <span class="text-danger">*</span></label>
                    <select name="center_id" class="form-control custom-select rounded-pill @error('center_id') is-invalid @enderror" required>
                        @foreach($centers as $center)
                            <option value="{{ $center->id }}" {{ old('center_id', $activity->center_id) == $center->id ? 'selected' : '' }}>
                                {{ $center->code }} - {{ $center->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('center_id') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4 form-group">
                    <label class="small font-weight-bold text-muted">Fecha y Hora de Inicio <span class="text-danger">*</span></label>
                    <input type="datetime-local" name="start_datetime" class="form-control rounded-pill @error('start_datetime') is-invalid @enderror" value="{{ old('start_datetime', $activity->start_datetime ? $activity->start_datetime->format('Y-m-d\TH:i') : '') }}" required>
                    @error('start_datetime') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4 form-group">
                    <label class="small font-weight-bold text-muted">Fecha y Hora de Término</label>
                    <input type="datetime-local" name="end_datetime" class="form-control rounded-pill @error('end_datetime') is-invalid @enderror" value="{{ old('end_datetime', $activity->end_datetime ? $activity->end_datetime->format('Y-m-d\TH:i') : '') }}">
                    @error('end_datetime') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4 form-group">
                    <label class="small font-weight-bold text-muted">Estado <span class="text-danger">*</span></label>
                    <select name="status" class="form-control custom-select rounded-pill @error('status') is-invalid @enderror" required>
                        <option value="SCHEDULED" {{ old('status', $activity->status) == 'SCHEDULED' ? 'selected' : '' }}>Programada</option>
                        <option value="COMPLETED" {{ old('status', $activity->status) == 'COMPLETED' ? 'selected' : '' }}>Realizada</option>
                        <option value="RESCHEDULED" {{ old('status', $activity->status) == 'RESCHEDULED' ? 'selected' : '' }}>Reprogramada</option>
                        <option value="CANCELLED" {{ old('status', $activity->status) == 'CANCELLED' ? 'selected' : '' }}>Cancelada</option>
                    </select>
                    @error('status') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label class="small font-weight-bold text-muted">Responsable / Expositor</label>
                    <input type="text" name="responsable_name" class="form-control rounded-pill @error('responsable_name') is-invalid @enderror" value="{{ old('responsable_name', $activity->responsable_name) }}">
                    @error('responsable_name') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label class="small font-weight-bold text-muted">Cantidad de Asistentes</label>
                    <input type="number" name="attendees_count" class="form-control rounded-pill @error('attendees_count') is-invalid @enderror" value="{{ old('attendees_count', $activity->attendees_count) }}" min="0">
                    @error('attendees_count') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-12 form-group">
                    <label class="small font-weight-bold text-muted">Descripción o Temario</label>
                    <textarea name="description" class="form-control rounded-lg @error('description') is-invalid @enderror" rows="3">{{ old('description', $activity->description) }}</textarea>
                    @error('description') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-12 form-group">
                    <label class="small font-weight-bold text-muted"><i class="fas fa-plus-circle mr-1"></i> Agregar Fotografías Adicionales</label>
                    <input type="file" name="evidences[]" class="form-control-file @error('evidences.*') is-invalid @enderror" accept="image/*" multiple>
                    <small class="text-muted d-block mt-1">Formatos: JPG, PNG, WEBP. Máx: 3MB c/u.</small>
                    @error('evidences.*') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- GALERÍA FOTOGRÁFICA --}}
            @if($activity->evidences->count() > 0)
                <h5 class="text-warning font-weight-bold mt-4 mb-3 border-bottom pb-2">
                    <i class="fas fa-images mr-1"></i> Evidencias Registradas ({{ $activity->evidences->count() }})
                </h5>
                <div class="row">
                    @foreach($activity->evidences as $evidence)
                        <div class="col-md-3 col-6 mb-3">
                            <div class="card h-100 shadow-sm border">
                                <img src="{{ asset('storage/' . $evidence->file_path) }}" class="card-img-top" style="height: 140px; object-fit: cover;">
                                <div class="card-body p-2 text-center bg-light">
                                    <form action="{{ route('admin.activities.evidences.destroy', $evidence) }}" method="POST" onsubmit="return confirm('¿Eliminar esta foto?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger btn-block font-weight-bold">
                                            <i class="fas fa-trash-alt mr-1"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
        <div class="card-footer text-right bg-light py-3">
            <button type="submit" class="btn btn-warning rounded-pill px-4 font-weight-bold text-dark shadow-sm">
                <i class="fas fa-sync-alt mr-1"></i> Actualizar Actividad
            </button>
        </div>
    </form>
</div>
@endsection