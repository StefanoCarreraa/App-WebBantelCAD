<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Region;

class StatsController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'daily'); // daily, weekly, monthly
        $regionId = $request->get('region_id');

        $query = DB::table('estadisticas_visitas')
            ->join('regiones', 'estadisticas_visitas.region_id', '=', 'regiones.id')
            ->leftJoin('centros', 'estadisticas_visitas.center_id', '=', 'centros.id')
            ->select(
                'regiones.name as region',
                'estadisticas_visitas.page_type',
                'centros.code as center_code',
                'centros.name as center_name',
                DB::raw('SUM(estadisticas_visitas.views_count) as total_views')
            );

        if ($regionId) {
            $query->where('estadisticas_visitas.region_id', $regionId);
        }

        if ($period == 'daily') {
            $query->where('estadisticas_visitas.visit_date', now()->toDateString());
        } elseif ($period == 'weekly') {
            $query->where('estadisticas_visitas.visit_date', '>=', now()->subDays(7)->toDateString());
        } elseif ($period == 'monthly') {
            $query->where('estadisticas_visitas.visit_date', '>=', now()->subDays(30)->toDateString());
        }

        $stats = $query
            ->groupBy(
                'regiones.name',
                'estadisticas_visitas.page_type',
                'centros.code',
                'centros.name'
            )
            ->orderByDesc('total_views')
            ->get();
        $regions = Region::where('status', true)->get();

        return view('web.admin.estadisticas.index', compact('stats', 'regions', 'period', 'regionId'));
    }
}