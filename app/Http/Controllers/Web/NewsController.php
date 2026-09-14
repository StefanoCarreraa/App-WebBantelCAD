<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Muestra el listado de noticias publicadas por región.
     */
    public function index(Request $request, $regionSlug)
    {
        $region = Region::where('slug', $regionSlug)->firstOrFail();

        $news = News::where('region_id', $region->id)
            ->where('status', 'PUBLISHED')
            ->orderBy('published_at', 'desc')
            ->paginate(6);

        return view('web.news.index', compact('region', 'news'));
    }

    /**
     * Muestra el detalle de una noticia.
     */
    public function show($regionSlug, $slug)
    {
        $region = Region::where('slug', $regionSlug)->firstOrFail();

        $article = News::where('region_id', $region->id)
            ->where('slug', $slug)
            ->where('status', 'PUBLISHED')
            ->firstOrFail();

        return view('web.news.show', compact('region', 'article'));
    }
}