<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\Center;
use Illuminate\Http\Request;

class CadController extends Controller
{
    /**
     * Muestra el listado general, buscador, filtros y mapa de los CAD/CAU por región.
     */
    public function index(Request $request, $regionSlug)
    {
        $region = Region::where('slug', $regionSlug)->firstOrFail();

        $query = Center::where('region_id', $region->id);

        // Filtro por tipo (CAD_A, CAD_B, CAU)
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filtro por provincia
        if ($request->filled('province')) {
            $query->where('province', $request->province);
        }

        // Filtro por distrito
        if ($request->filled('district')) {
            $query->where('district', $request->district);
        }

        // Buscador por palabra, código o localidad
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhere('locality', 'like', "%{$search}%");
            });
        }

        $centers = $query->orderBy('code')->paginate(12)->withQueryString();

        // Listas para los desplegables de filtros
        $provinces = Center::where('region_id', $region->id)->distinct()->pluck('province');

        // Cifras para las tarjetas del módulo
        $stats = [
            'total' => Center::where('region_id', $region->id)->count(),
            'cad_a' => Center::where('region_id', $region->id)->where('type', 'CAD_A')->count(),
            'cad_b' => Center::where('region_id', $region->id)->where('type', 'CAD_B')->count(),
            'cau' => Center::where('region_id', $region->id)->where('type', 'CAU')->count(),
        ];

        return view('web.centros.index', compact('region', 'centers', 'provinces', 'stats'));
    }

    /**
     * Muestra la ficha individual del CAD o CAU según su código oficial.
     */
    public function show($regionSlug, $code)
    {
        $region = Region::where('slug', $regionSlug)->firstOrFail();

        $center = Center::where('region_id', $region->id)
            ->where('code', $code)
            ->with(['activities' => function ($q) {
                $q->orderBy('start_datetime', 'asc');
            }])
            ->firstOrFail();

        return view('web.centros.show', compact('region', 'center'));
    }

    /**
     * Muestra la sección exclusiva para los Centros de Atención al Usuario (CAU).
     */
    public function cauIndex(Request $request, $regionSlug)
    {
        // 1. Obtener la región por su slug o lanzar error 404
        $region = Region::where('slug', $regionSlug)->firstOrFail();

        // 2. Obtener las provincias únicas registradas para los centros CAU de la región
        $provinces = Center::where('region_id', $region->id)
            ->where('type', 'CAU')
            ->whereNotNull('province')
            ->distinct()
            ->orderBy('province', 'asc')
            ->pluck('province');

        // 3. Construir la consulta de centros CAU filtrados
        $query = Center::where('region_id', $region->id)
            ->where('type', 'CAU');

        // Filtro por texto (Búsqueda por nombre, código, localidad o distrito)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhere('locality', 'like', "%{$search}%")
                    ->orWhere('district', 'like', "%{$search}%");
            });
        }

        // Filtro por provincia
        if ($request->filled('province')) {
            $query->where('province', $request->input('province'));
        }

        // 4. Obtener resultados paginados
        $caus = $query->orderBy('code')->paginate(10)->withQueryString();

        // 5. Retornar vista pasando la variable $provinces requerida
        return view('web.cau.index', compact('region', 'caus', 'provinces'));
    }
}
