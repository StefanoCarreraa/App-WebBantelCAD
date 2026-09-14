@extends('layouts.admin')

@section('title', 'Editar Noticia: ' . Str::limit($news->title, 30))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
    <div>
        <h1 class="h3 font-weight-bold text-dark mb-1">
            <i class="fas fa-edit text-warning mr-2"></i>Editar Noticia
        </h1>
        <p class="text-muted small mb-0">Modifique la información publicada en la nota periodística</p>
    </div>
    <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill font-weight-bold">
        <i class="fas fa-arrow-left mr-1"></i> Volver al listado
    </a>
</div>

<div class="card card-outline card-warning shadow-sm rounded-lg" data-aos="fade-up">
    <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="card-body p-4">
            
            <h5 class="text-warning font-weight-bold mb-3 border-bottom pb-2">
                <i class="fas fa-edit mr-1"></i> Edición de Contenido
            </h5>
            
            <div class="row">
                <div class="col-md-12 form-group">
                    <label class="small font-weight-bold text-muted">Título del Artículo <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control rounded-pill @error('title') is-invalid @enderror" value="{{ old('title', $news->title) }}" required>
                    @error('title') 
                        <span class="text-danger small d-block mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label class="small font-weight-bold text-muted">Región <span class="text-danger">*</span></label>
                    <select name="region_id" class="form-control custom-select rounded-pill @error('region_id') is-invalid @enderror" required>
                        @foreach($regions as $region)
                            <option value="{{ $region->id }}" {{ old('region_id', $news->region_id) == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                        @endforeach
                    </select>
                    @error('region_id') 
                        <span class="text-danger small d-block mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label class="small font-weight-bold text-muted">Estado de Publicación <span class="text-danger">*</span></label>
                    <select name="status" class="form-control custom-select rounded-pill @error('status') is-invalid @enderror" required>
                        <option value="PUBLISHED" {{ old('status', $news->status) == 'PUBLISHED' ? 'selected' : '' }}>Publicado</option>
                        <option value="DRAFT" {{ old('status', $news->status) == 'DRAFT' ? 'selected' : '' }}>Borrador</option>
                        <option value="ARCHIVED" {{ old('status', $news->status) == 'ARCHIVED' ? 'selected' : '' }}>Archivado</option>
                    </select>
                    @error('status') 
                        <span class="text-danger small d-block mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="col-md-12 form-group">
                    <label class="small font-weight-bold text-muted">Resumen Breve <span class="text-danger">*</span></label>
                    <textarea name="summary" class="form-control rounded-lg @error('summary') is-invalid @enderror" rows="2" maxlength="500" required>{{ old('summary', $news->summary) }}</textarea>
                    @error('summary') 
                        <span class="text-danger small d-block mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="col-md-12 form-group">
                    <label class="small font-weight-bold text-muted">Contenido Completo <span class="text-danger">*</span></label>
                    <textarea name="content" class="form-control rounded-lg @error('content') is-invalid @enderror" rows="8" required>{{ old('content', $news->content) }}</textarea>
                    @error('content') 
                        <span class="text-danger small d-block mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label class="small font-weight-bold text-muted"><i class="fas fa-image mr-1"></i> Actualizar Imagen Principal</label>
                    <input type="file" name="main_image" class="form-control-file @error('main_image') is-invalid @enderror" accept="image/*">
                    @if($news->main_image)
                        <div class="mt-2 p-2 border rounded bg-light d-inline-block">
                            <small class="text-success font-weight-bold d-block"><i class="fas fa-check-circle mr-1"></i> Imagen actual registrada:</small>
                            <img src="{{ asset('storage/' . $news->main_image) }}" alt="Portada actual" class="img-thumbnail mt-1" style="max-height: 80px;">
                        </div>
                    @endif
                    @error('main_image') 
                        <span class="text-danger small d-block mt-1">{{ $message }}</span> 
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="card-footer text-right bg-light py-3">
            <button type="submit" class="btn btn-warning rounded-pill px-4 font-weight-bold text-dark shadow-sm">
                <i class="fas fa-sync-alt mr-1"></i> Actualizar Noticia
            </button>
        </div>
    </form>
</div>
@endsection