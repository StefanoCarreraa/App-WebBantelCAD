@extends('layouts.admin')

@section('title', 'Subir Nuevo Recurso - BANDTEL Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
    <div>
        <h1 class="h3 font-weight-bold text-dark mb-1">
            <i class="fas fa-file-upload text-primary mr-2"></i>Subir Recurso Digital o Enlace
        </h1>
        <p class="text-muted small mb-0">Agregue guías, manuales PDF o enlaces institucionales para los centros CAD / CAU</p>
    </div>
    <a href="{{ route('admin.resources.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill font-weight-bold">
        <i class="fas fa-arrow-left mr-1"></i> Volver al listado
    </a>
</div>

<div class="card card-outline card-primary shadow-sm rounded-lg" data-aos="fade-up">
    <form action="{{ route('admin.resources.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body p-4">
            
            <h5 class="text-primary font-weight-bold mb-3 border-bottom pb-2">
                <i class="fas fa-info-circle mr-1"></i> Datos del Recurso
            </h5>
            
            <div class="row">
                <div class="col-md-12 form-group">
                    <label class="small font-weight-bold text-muted">Título del Recurso o Guía <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control rounded-pill @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Ej: Manual de Alfabetización Digital 2026..." required>
                    @error('title') 
                        <span class="text-danger small d-block mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label class="small font-weight-bold text-muted">Región Pertinente <span class="text-danger">*</span></label>
                    <select name="region_id" class="form-control custom-select rounded-pill @error('region_id') is-invalid @enderror" required>
                        <option value="">-- Seleccionar Región --</option>
                        @foreach($regions as $region)
                            <option value="{{ $region->id }}" {{ old('region_id') == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                        @endforeach
                    </select>
                    @error('region_id') 
                        <span class="text-danger small d-block mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label class="small font-weight-bold text-muted">Tipo / Formato de Documento <span class="text-danger">*</span></label>
                    <select name="file_type" class="form-control custom-select rounded-pill @error('file_type') is-invalid @enderror" required>
                        <option value="PDF" {{ old('file_type') == 'PDF' ? 'selected' : '' }}>Documento PDF</option>
                        <option value="DOCX" {{ old('file_type') == 'DOCX' ? 'selected' : '' }}>Documento Word (.docx)</option>
                        <option value="XLSX" {{ old('file_type') == 'XLSX' ? 'selected' : '' }}>Hoja de Cálculo (.xlsx)</option>
                        <option value="LINK" {{ old('file_type') == 'LINK' ? 'selected' : '' }}>Enlace Web Externo</option>
                    </select>
                    @error('file_type') 
                        <span class="text-danger small d-block mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="col-md-12 form-group">
                    <label class="small font-weight-bold text-muted">Descripción Breve</label>
                    <textarea name="description" class="form-control rounded-lg @error('description') is-invalid @enderror" rows="3" placeholder="Detalle el contenido o propósito de este recurso digital...">{{ old('description') }}</textarea>
                    @error('description') 
                        <span class="text-danger small d-block mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label class="small font-weight-bold text-muted"><i class="fas fa-file-upload mr-1"></i> Archivo adjunto (PDF / Docs)</label>
                    <input type="file" name="file" class="form-control-file @error('file') is-invalid @enderror">
                    <small class="text-muted d-block mt-1">Soporta PDF, DOCX, XLSX (Máx: 10MB)</small>
                    @error('file') 
                        <span class="text-danger small d-block mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label class="small font-weight-bold text-muted"><i class="fas fa-link mr-1"></i> Enlace Externo (Opcional si sube archivo)</label>
                    <input type="url" name="external_url" class="form-control rounded-pill @error('external_url') is-invalid @enderror" value="{{ old('external_url') }}" placeholder="https://ejemplo.gob.pe/recurso">
                    @error('external_url') 
                        <span class="text-danger small d-block mt-1">{{ $message }}</span> 
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="card-footer text-right bg-light py-3">
            <button type="submit" class="btn btn-primary rounded-pill px-4 font-weight-bold shadow-sm">
                <i class="fas fa-cloud-upload-alt mr-1"></i> Registrar Recurso
            </button>
        </div>
    </form>
</div>
@endsection