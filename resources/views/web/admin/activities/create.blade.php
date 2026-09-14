@extends('layouts.admin')

@section('title', 'Programar Nueva Actividad')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
    <div>
        <h1 class="h3 font-weight-bold text-dark mb-1">
            <i class="fas fa-calendar-plus text-success mr-2"></i>Programar Nueva Actividad
        </h1>
        <p class="text-muted small mb-0">Complete la información requerida para la agenda de los centros CAD / CAU</p>
    </div>
    <a href="{{ route('admin.activities.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill font-weight-bold">
        <i class="fas fa-arrow-left mr-1"></i> Volver al listado
    </a>
</div>

<div class="card card-outline card-success shadow-sm rounded-lg" data-aos="fade-up">
    <form action="{{ route('admin.activities.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body p-4">
            <div class="row">
                <div class="col-md-8 form-group">
                    <label class="small font-weight-bold text-muted">Título de la Actividad / Taller <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control rounded-pill @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Ej: Capacitación sobre Trámites Digitales Gob.pe" required>
                    @error('title') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4 form-group">
                    <label class="small font-weight-bold text-muted">Centro Asociado <span class="text-danger">*</span></label>
                    <select name="center_id" class="form-control custom-select rounded-pill @error('center_id') is-invalid @enderror" required>
                        <option value="">-- Seleccionar Centro --</option>
                        @foreach($centers as $center)
                            <option value="{{ $center->id }}" {{ old('center_id') == $center->id ? 'selected' : '' }}>
                                {{ $center->code }} - {{ $center->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('center_id') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4 form-group">
                    <label class="small font-weight-bold text-muted">Fecha y Hora de Inicio <span class="text-danger">*</span></label>
                    <input type="datetime-local" name="start_datetime" class="form-control rounded-pill @error('start_datetime') is-invalid @enderror" value="{{ old('start_datetime') }}" required>
                    @error('start_datetime') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4 form-group">
                    <label class="small font-weight-bold text-muted">Fecha y Hora de Término</label>
                    <input type="datetime-local" name="end_datetime" class="form-control rounded-pill @error('end_datetime') is-invalid @enderror" value="{{ old('end_datetime') }}">
                    @error('end_datetime') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4 form-group">
                    <label class="small font-weight-bold text-muted">Estado <span class="text-danger">*</span></label>
                    <select name="status" class="form-control custom-select rounded-pill @error('status') is-invalid @enderror" required>
                        <option value="SCHEDULED" {{ old('status', 'SCHEDULED') == 'SCHEDULED' ? 'selected' : '' }}>Programada</option>
                        <option value="COMPLETED" {{ old('status') == 'COMPLETED' ? 'selected' : '' }}>Realizada</option>
                        <option value="RESCHEDULED" {{ old('status') == 'RESCHEDULED' ? 'selected' : '' }}>Reprogramada</option>
                        <option value="CANCELLED" {{ old('status') == 'CANCELLED' ? 'selected' : '' }}>Cancelada</option>
                    </select>
                    @error('status') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label class="small font-weight-bold text-muted">Responsable / Expositor</label>
                    <input type="text" name="responsable_name" class="form-control rounded-pill @error('responsable_name') is-invalid @enderror" value="{{ old('responsable_name') }}" placeholder="Ej: Ing. Marco Antonio Solís">
                    @error('responsable_name') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label class="small font-weight-bold text-muted">Cantidad de Asistentes</label>
                    <input type="number" name="attendees_count" class="form-control rounded-pill @error('attendees_count') is-invalid @enderror" value="{{ old('attendees_count', 0) }}" min="0">
                    @error('attendees_count') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-12 form-group">
                    <label class="small font-weight-bold text-muted">Descripción o Temario</label>
                    <textarea name="description" class="form-control rounded-lg @error('description') is-invalid @enderror" rows="3" placeholder="Detalle los puntos clave o agenda de la sesión...">{{ old('description') }}</textarea>
                    @error('description') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-12 form-group">
                    <label class="small font-weight-bold text-muted"><i class="fas fa-camera mr-1"></i> Adjuntar Evidencias Fotográficas</label>
                    <input type="file" name="evidences[]" class="form-control-file @error('evidences.*') is-invalid @enderror" accept="image/*" multiple>
                    <small class="text-muted d-block mt-1">Puede seleccionar múltiples fotos. Formatos: JPG, PNG, WEBP. Máx: 3MB c/u.</small>
                    @error('evidences.*') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <div class="card-footer text-right bg-light py-3">
            <button type="submit" class="btn btn-success rounded-pill px-4 font-weight-bold shadow-sm">
                <i class="fas fa-save mr-1"></i> Guardar Actividad
            </button>
        </div>
    </form>
</div>
@endsection