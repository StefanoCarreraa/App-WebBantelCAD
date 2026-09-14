@extends('layouts.admin')

@section('title', 'Noticias - BANDTEL Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
    <div>
        <h1 class="h3 font-weight-bold text-dark mb-1">
            <i class="fas fa-newspaper text-warning mr-2"></i>Gestión de Noticias y Experiencias
        </h1>
        <p class="text-muted small mb-0">Administre las publicaciones y novedades institucionales de las regiones</p>
    </div>
    <a href="{{ route('admin.news.create') }}" class="btn btn-warning btn-sm rounded-pill font-weight-bold text-dark shadow-sm transition-hover">
        <i class="fas fa-pen mr-1"></i> Redactar Noticia
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-lg shadow-sm border-0 mb-4" role="alert" data-aos="fade-in">
        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="card card-outline card-warning shadow-sm rounded-lg overflow-hidden" data-aos="fade-up">
    <div class="card-body p-0 table-responsive">
        <table class="table table-hover table-striped table-valign-middle mb-0">
            <thead class="thead-dark">
                <tr>
                    <th class="py-3 pl-4">Título del Artículo</th>
                    <th class="py-3">Región</th>
                    <th class="py-3">Fecha Publicación</th>
                    <th class="py-3 text-center">Estado</th>
                    <th class="py-3 text-right pr-4">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($news as $article)
                    <tr class="transition-row">
                        <td class="font-weight-bold text-dark pl-4 align-middle">
                            {{ Str::limit($article->title, 55) }}
                        </td>
                        <td class="align-middle">
                            <span class="badge badge-light border px-2 py-1 font-weight-bold">
                                <i class="fas fa-map-marker-alt text-danger mr-1"></i>{{ $article->region->name ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="align-middle">
                            <small class="text-dark font-weight-bold d-block">
                                <i class="far fa-calendar-alt text-primary mr-1"></i>{{ $article->published_at ? $article->published_at->format('d/m/Y') : 'Sin fecha' }}
                            </small>
                        </td>
                        <td class="text-center align-middle">
                            <span class="badge badge-{{ $article->status === 'PUBLISHED' ? 'success' : ($article->status === 'DRAFT' ? 'secondary' : 'warning') }} px-3 py-1 font-weight-bold shadow-xs">
                                {{ $article->status }}
                            </span>
                        </td>
                        <td class="text-right align-middle pr-4">
                            <a href="{{ route('admin.news.edit', $article) }}" class="btn btn-sm btn-outline-warning rounded-circle shadow-xs mr-1" title="Editar Noticia">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.news.destroy', $article) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Confirma la eliminación permanente de esta noticia?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle shadow-xs" title="Eliminar Noticia">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="fas fa-newspaper fa-3x mb-3 d-block text-secondary"></i>
                            <p class="mb-0 font-weight-bold">No hay noticias o notas periodísticas registradas.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center mt-4" data-aos="fade-up">
    {{ $news->links() }}
</div>
@endsection