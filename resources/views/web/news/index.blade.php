@extends('layouts.web')

@section('title', 'Noticias y Experiencias - ' . $region->name)

@section('content')
<div class="content-header bg-light mb-4 py-4 border-bottom">
    <div class="container">
        <h1 class="m-0 text-dark">Noticias y Experiencias</h1>
        <p class="text-muted mb-0">Novedades y actividades en la región {{ $region->name }}</p>
    </div>
</div>

<div class="container mb-5">
    <div class="row">
        @forelse($news as $article)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    @if($article->main_image)
                        <img src="{{ asset('storage/' . $article->main_image) }}" class="card-img-top" alt="{{ $article->title }}" style="height: 200px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/400x200?text=CAD+Noticias" class="card-img-top" alt="Noticia">
                    @endif
                    <div class="card-body">
                        <small class="text-muted"><i class="far fa-calendar-alt mr-1"></i> {{ $article->published_at ? $article->published_at->format('d/m/Y') : '' }}</small>
                        <h5 class="card-title font-weight-bold text-dark w-100 my-2">{{ $article->title }}</h5>
                        <p class="card-text text-secondary small">{{ Str::limit($article->summary, 110) }}</p>
                    </div>
                    <div class="card-footer bg-white border-top-0 pt-0">
                        <a href="{{ route('news.show', ['region' => $region->slug, 'slug' => $article->slug]) }}" class="btn btn-sm btn-outline-primary btn-block">Leer Más</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 py-5 text-center text-muted">
                <p>No hay publicaciones registradas por el momento.</p>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $news->links() }}
    </div>
</div>
@endsection