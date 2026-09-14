@extends('layouts.admin')

@section('title', 'Editar Centro: ' . $center->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
    <div>
        <h1 class="h3 font-weight-bold text-dark mb-1">
            <i class="fas fa-edit text-warning mr-2"></i>Editar Centro: {{ $center->name }}
        </h1>
        <p class="text-muted small mb-0">Modifique los datos requeridos para actualizar la información del centro</p>
    </div>
    <a href="{{ route('admin.centers.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill font-weight-bold">
        <i class="fas fa-arrow-left mr-1"></i> Volver al listado
    </a>
</div>

<div class="card card-outline card-warning shadow-sm rounded-lg" data-aos="fade-up">
    <form action="{{ route('admin.centers.update', $center) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="card-body p-4">
            
            {{-- BLOQUE 1: DATOS GENERALES --}}
            <h5 class="text-warning font-weight-bold mb-3 border-bottom pb-2">
                <i class="fas fa-info-circle mr-1"></i> Datos Generales
            </h5>
            <div class="row">
                <div class="col-md-3 form-group">
                    <label class="small font-weight-bold text-muted">Código Oficial <span class="text-danger">*</span></label>
                    <input type="text" name="code" class="form-control rounded-pill @error('code') is-invalid @enderror" value="{{ old('code', $center->code) }}" required>
                    @error('code') 
                        <span class="text-danger small d-block mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="col-md-3 form-group">
                    <label class="small font-weight-bold text-muted">Región <span class="text-danger">*</span></label>
                    <select name="region_id" class="form-control custom-select rounded-pill @error('region_id') is-invalid @enderror" required>
                        @foreach($regions as $region)
                            <option value="{{ $region->id }}" {{ old('region_id', $center->region_id) == $region->id ? 'selected' : '' }}>
                                {{ $region->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('region_id') 
                        <span class="text-danger small d-block mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="col-md-3 form-group">
                    <label class="small font-weight-bold text-muted">Tipo de Centro <span class="text-danger">*</span></label>
                    <select name="type" class="form-control custom-select rounded-pill @error('type') is-invalid @enderror" required>
                        <option value="CAD_A" {{ old('type', $center->type) == 'CAD_A' ? 'selected' : '' }}>CAD Tipo A</option>
                        <option value="CAD_B" {{ old('type', $center->type) == 'CAD_B' ? 'selected' : '' }}>CAD Tipo B</option>
                        <option value="CAU" {{ old('type', $center->type) == 'CAU' ? 'selected' : '' }}>Centro de Atención al Usuario (CAU)</option>
                    </select>
                    @error('type') 
                        <span class="text-danger small d-block mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="col-md-3 form-group">
                    <label class="small font-weight-bold text-muted">Estado <span class="text-danger">*</span></label>
                    <select name="status" class="form-control custom-select rounded-pill @error('status') is-invalid @enderror" required>
                        <option value="OPERATIVE" {{ old('status', $center->status) == 'OPERATIVE' ? 'selected' : '' }}>Operativo</option>
                        <option value="MAINTENANCE" {{ old('status', $center->status) == 'MAINTENANCE' ? 'selected' : '' }}>En Mantenimiento</option>
                        <option value="INACTIVE" {{ old('status', $center->status) == 'INACTIVE' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('status') 
                        <span class="text-danger small d-block mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="col-md-12 form-group">
                    <label class="small font-weight-bold text-muted">Nombre del Centro <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control rounded-pill @error('name') is-invalid @enderror" value="{{ old('name', $center->name) }}" required>
                    @error('name') 
                        <span class="text-danger small d-block mt-1">{{ $message }}</span> 
                    @enderror
                </div>
            </div>

            {{-- BLOQUE 2: UBICACIÓN Y GEORREFERENCIACIÓN --}}
            <h5 class="text-warning font-weight-bold mt-4 mb-3 border-bottom pb-2">
                <i class="fas fa-map-marked-alt mr-1"></i> Ubicación y Georreferenciación
            </h5>
            <div class="row">
                <div class="col-md-4 form-group">
                    <label class="small font-weight-bold text-muted">Provincia <span class="text-danger">*</span></label>
                    <input type="text" name="province" class="form-control rounded-pill @error('province') is-invalid @enderror" value="{{ old('province', $center->province) }}" required>
                    @error('province') 
                        <span class="text-danger small d-block mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="col-md-4 form-group">
                    <label class="small font-weight-bold text-muted">Distrito <span class="text-danger">*</span></label>
                    <input type="text" name="district" class="form-control rounded-pill @error('district') is-invalid @enderror" value="{{ old('district', $center->district) }}" required>
                    @error('district') 
                        <span class="text-danger small d-block mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="col-md-4 form-group">
                    <label class="small font-weight-bold text-muted">Localidad / C.P. <span class="text-danger">*</span></label>
                    <input type="text" name="locality" class="form-control rounded-pill @error('locality') is-invalid @enderror" value="{{ old('locality', $center->locality) }}" required>
                    @error('locality') 
                        <span class="text-danger small d-block mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label class="small font-weight-bold text-muted">Dirección / Referencia</label>
                    <input type="text" name="address" class="form-control rounded-pill @error('address') is-invalid @enderror" value="{{ old('address', $center->address) }}">
                    @error('address') 
                        <span class="text-danger small d-block mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="col-md-3 form-group">
                    <label class="small font-weight-bold text-muted">Latitud</label>
                    <input type="text" name="latitude" class="form-control rounded-pill @error('latitude') is-invalid @enderror" value="{{ old('latitude', $center->latitude) }}">
                    @error('latitude') 
                        <span class="text-danger small d-block mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="col-md-3 form-group">
                    <label class="small font-weight-bold text-muted">Longitud</label>
                    <input type="text" name="longitude" class="form-control rounded-pill @error('longitude') is-invalid @enderror" value="{{ old('longitude', $center->longitude) }}">
                    @error('longitude') 
                        <span class="text-danger small d-block mt-1">{{ $message }}</span> 
                    @enderror
                </div>
            </div>

            {{-- BLOQUE 3: INFORMACIÓN ADICIONAL --}}
            <h5 class="text-warning font-weight-bold mt-4 mb-3 border-bottom pb-2">
                <i class="fas fa-clock mr-1"></i> Información Adicional
            </h5>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label class="small font-weight-bold text-muted">Horario de Atención</label>
                    <input type="text" name="schedule" class="form-control rounded-pill @error('schedule') is-invalid @enderror" value="{{ old('schedule', $center->schedule) }}">
                    @error('schedule') 
                        <span class="text-danger small d-block mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label class="small font-weight-bold text-muted">Teléfono de Contacto</label>
                    <input type="text" name="phone" class="form-control rounded-pill @error('phone') is-invalid @enderror" value="{{ old('phone', $center->phone) }}">
                    @error('phone') 
                        <span class="text-danger small d-block mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label class="small font-weight-bold text-muted">Actualizar Fotografía</label>
                    <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror" accept="image/*">
                    @if($center->image_path)
                        <small class="text-success font-weight-bold d-block mt-2">
                            <i class="fas fa-image mr-1"></i> Imagen actual registrada
                        </small>
                    @endif
                    @error('image') 
                        <span class="text-danger small d-block mt-1">{{ $message }}</span> 
                    @enderror
                </div>
            </div>

        </div>
        <div class="card-footer text-right bg-light py-3">
            <button type="submit" class="btn btn-warning rounded-pill px-4 font-weight-bold text-dark shadow-sm">
                <i class="fas fa-sync-alt mr-1"></i> Actualizar Centro
            </button>
        </div>
    </form>
</div>
@endsection