@extends('layouts.web')

@section('title', $article->title . ' - ' . $region->name)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <a href="{{ route('noticias.index', ['region' => $region->slug]) }}" class="btn btn-sm btn-outline-secondary mb-3">
                <i class="fas fa-arrow-left"></i> Volver a Noticias
            </a>
            <h1 class="font-weight-bold text-dark mb-2">{{ $article->title }}</h1>
            <p class="text-muted"><i class="far fa-clock mr-1"></i> Publicado el {{ $article->published_at ? $article->published_at->format('d/m/Y h:i A') : '' }}</p>
            
            @if($article->main_image)
                <img src="{{ asset('storage/' . $article->main_image) }}" class="img-fluid rounded mb-4 w-100" style="max-height: 450px; object-fit: cover;">
            @endif

            <div class="article-content text-secondary leading-relaxed mb-5" style="font-size: 1.1rem; line-height: 1.8;">
                {!! nl2br(e($article->content)) !!}
            </div>
        </div>
    </div>
</div>
@endsection