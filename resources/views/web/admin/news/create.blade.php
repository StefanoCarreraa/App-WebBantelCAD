@extends('layouts.admin')

@section('title', 'Redactar Noticia - BANDTEL Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
    <div>
        <h1 class="h3 font-weight-bold text-dark mb-1">
            <i class="fas fa-plus-circle text-success mr-2"></i>Redactar Nueva Noticia
        </h1>
        <p class="text-muted small mb-0">Complete la información requerida para la nota institucional</p>
    </div>
    <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill font-weight-bold">
        <i class="fas fa-arrow-left mr-1"></i> Volver al listado
    </a>
</div>

<div class="card card-outline card-success shadow-sm rounded-lg" data-aos="fade-up">
    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body p-4">
            
            <h5 class="text-success font-weight-bold mb-3 border-bottom pb-2">
                <i class="fas fa-align-left mr-1"></i> Información General del Artículo
            </h5>
            
            <div class="row">
                <div class="col-md-12 form-group">
                    <label class="small font-weight-bold text-muted">Título del Artículo <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control rounded-pill @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Ej: Inauguración de nuevo punto CAD..." required>
                    @error('title') 
                        <span class="text-danger small d-block mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label class="small font-weight-bold text-muted">Región <span class="text-danger">*</span></label>
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
                    <label class="small font-weight-bold text-muted">Estado de Publicación <span class="text-danger">*</span></label>
                    <select name="status" class="form-control custom-select rounded-pill @error('status') is-invalid @enderror" required>
                        <option value="PUBLISHED" {{ old('status', 'PUBLISHED') == 'PUBLISHED' ? 'selected' : '' }}>Publicado</option>
                        <option value="DRAFT" {{ old('status') == 'DRAFT' ? 'selected' : '' }}>Borrador</option>
                        <option value="ARCHIVED" {{ old('status') == 'ARCHIVED' ? 'selected' : '' }}>Archivado</option>
                    </select>
                    @error('status') 
                        <span class="text-danger small d-block mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="col-md-12 form-group">
                    <label class="small font-weight-bold text-muted">Resumen Breve (Para tarjetas de presentación) <span class="text-danger">*</span></label>
                    <textarea name="summary" class="form-control rounded-lg @error('summary') is-invalid @enderror" rows="2" maxlength="500" placeholder="Ingrese una breve bajada de texto..." required>{{ old('summary') }}</textarea>
                    @error('summary') 
                        <span class="text-danger small d-block mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="col-md-12 form-group">
                    <label class="small font-weight-bold text-muted">Contenido Completo del Artículo <span class="text-danger">*</span></label>
                    <textarea name="content" class="form-control rounded-lg @error('content') is-invalid @enderror" rows="8" placeholder="Redacte el cuerpo principal de la noticia..." required>{{ old('content') }}</textarea>
                    @error('content') 
                        <span class="text-danger small d-block mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label class="small font-weight-bold text-muted"><i class="fas fa-image mr-1"></i> Imagen Principal de Portada</label>
                    <input type="file" name="main_image" class="form-control-file @error('main_image') is-invalid @enderror" accept="image/*">
                    <small class="text-muted d-block mt-1">Formatos recomendados: JPG, PNG, WEBP. Máx: 2MB.</small>
                    @error('main_image') 
                        <span class="text-danger small d-block mt-1">{{ $message }}</span> 
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="card-footer text-right bg-light py-3">
            <button type="submit" class="btn btn-success rounded-pill px-4 font-weight-bold shadow-sm">
                <i class="fas fa-paper-plane mr-1"></i> Guardar y Publicar
            </button>
        </div>
    </form>
</div>
@endsection