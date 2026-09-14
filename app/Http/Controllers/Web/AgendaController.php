<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\Activity;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    /**
     * Muestra el listado de actividades de la agenda con filtros por fecha y centro.
     */
    public function index(Request $request, $regionSlug)
    {
        $region = Region::where('slug', $regionSlug)->firstOrFail();

        $query = Activity::whereHas('center', function($q) use ($region) {
            $q->where('region_id', $region->id);
        });

        // Filtrar por estado de la actividad (Programada, Realizada, etc.)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        } else {
            $query->where('status', 'SCHEDULED');
        }

        // Búsqueda por título o categoría
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $activities = $query->orderBy('start_datetime', 'asc')->paginate(9)->withQueryString();

        return view('web.agenda.index', compact('region', 'activities'));
    }
}