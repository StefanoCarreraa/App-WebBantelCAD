<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Region;

class NewsApiController extends Controller
{
    public function index($regionSlug)
    {
        $region = Region::where('slug', $regionSlug)->firstOrFail();

        $news = News::where('region_id', $region->id)
            ->where('status', 'PUBLISHED')
            ->orderBy('published_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'region' => $region->name,
            'data' => $news
        ], 200);
    }
}