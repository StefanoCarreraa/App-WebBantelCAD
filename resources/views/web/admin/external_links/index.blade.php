@extends('layouts.admin')

@section('title', 'Enlaces Externos - BANDTEL Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
    <div>
        <h1 class="h3 font-weight-bold text-dark mb-1">
            <i class="fas fa-link text-info mr-2"></i>Gestión de Enlaces Externos
        </h1>
        <p class="text-muted small mb-0">Administre los accesos rápidos y portales institucionales por región</p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-lg shadow-sm border-0 mb-4" role="alert" data-aos="fade-in">
        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="row">
    {{-- FORMULARIO DE REGISTRO RÁPIDO --}}
    <div class="col-md-4 mb-4" data-aos="fade-right">
        <div class="card card-outline card-info shadow-sm rounded-lg">
            <div class="card-header bg-light">
                <h5 class="card-title font-weight-bold text-dark mb-0">
                    <i class="fas fa-plus-circle text-info mr-1"></i> Agregar Nuevo Enlace
                </h5>
            </div>
            <form action="{{ route('admin.external-links.store') }}" method="POST">
                @csrf
                <div class="card-body p-3">
                    <div class="form-group">
                        <label class="small font-weight-bold text-muted">Título del Sitio <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control rounded-pill @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Ej: Portal Gob.pe" required>
                        @error('title') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label class="small font-weight-bold text-muted">URL Externa <span class="text-danger">*</span></label>
                        <input type="url" name="url" class="form-control rounded-pill @error('url') is-invalid @enderror" value="{{ old('url') }}" placeholder="https://www.gob.pe" required>
                        @error('url') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label class="small font-weight-bold text-muted">Región <span class="text-danger">*</span></label>
                        <select name="region_id" class="form-control custom-select rounded-pill @error('region_id') is-invalid @enderror" required>
                            <option value="">-- Seleccionar Región --</option>
                            @foreach($regions as $region)
                                <option value="{{ $region->id }}" {{ old('region_id') == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                            @endforeach
                        </select>
                        @error('region_id') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-0">
                        <label class="small font-weight-bold text-muted">Categoría <span class="text-danger">*</span></label>
                        <input type="text" name="category" class="form-control rounded-pill @error('category') is-invalid @enderror" value="{{ old('category', 'Trámites y Servicios') }}" placeholder="Ej: Servicios Públicos" required>
                        @error('category') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="card-footer text-right bg-light py-2">
                    <button type="submit" class="btn btn-info btn-block rounded-pill font-weight-bold shadow-sm">
                        <i class="fas fa-save mr-1"></i> Guardar Enlace
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- TABLA DE LISTADO DE ENLACES --}}
    <div class="col-md-8" data-aos="fade-left">
        <div class="card card-outline card-info shadow-sm rounded-lg overflow-hidden">
            <div class="card-body p-0 table-responsive">
                <table class="table table-hover table-striped table-valign-middle mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th class="py-3 pl-4">Título / Categoría</th>
                            <th class="py-3">Región</th>
                            <th class="py-3">URL</th>
                            <th class="py-3 text-right pr-4">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($links as $link)
                            <tr>
                                <td class="pl-4 align-middle">
                                    <span class="font-weight-bold text-dark d-block">{{ Str::limit($link->title, 40) }}</span>
                                    <small class="text-muted"><i class="fas fa-tag mr-1"></i>{{ $link->category }}</small>
                                </td>
                                <td class="align-middle">
                                    <span class="badge badge-light border px-2 py-1 font-weight-bold">
                                        <i class="fas fa-map-marker-alt text-danger mr-1"></i>{{ $link->region->name ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="align-middle">
                                    <a href="{{ $link->url }}" target="_blank" class="small font-weight-bold text-primary">
                                        {{ Str::limit($link->url, 30) }} <i class="fas fa-external-link-alt ml-1"></i>
                                    </a>
                                </td>
                                <td class="text-right align-middle pr-4">
                                    <form action="{{ route('admin.external-links.destroy', $link) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este enlace externo?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle shadow-xs" title="Eliminar Enlace">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="fas fa-link fa-3x mb-3 d-block text-secondary"></i>
                                    <p class="mb-0 font-weight-bold">No hay enlaces externos registrados.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $links->links() }}
        </div>
    </div>
</div>
@endsection