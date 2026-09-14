<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Support\Facades\DB;

class ResourceController extends Controller
{
    /**
     * Muestra las guías, tutoriales y directorio de enlaces útiles.
     */
    public function index($regionSlug)
    {
        $region = Region::where('slug', $regionSlug)->firstOrFail();

        // Consulta a las tablas creadas en la migración transversal
        $resources = DB::table('recursos_digitales')
            ->where('region_id', $region->id)
            ->get();

        $externalLinks = DB::table('enlaces_externos')
            ->where('region_id', $region->id)
            ->where('is_active', true)
            ->get()
            ->groupBy('category');

        return view('web.recursos.index', compact('region', 'resources', 'externalLinks'));
    }
}