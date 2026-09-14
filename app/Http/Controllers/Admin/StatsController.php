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

        $query = DB::table('visit_stats')
            ->join('regions', 'visit_stats.region_id', '=', 'regions.id')
            ->select('regions.name as region', 'visit_stats.page_type', DB::raw('SUM(views_count) as total_views'));

        if ($regionId) {
            $query->where('region_id', $regionId);
        }

        if ($period == 'daily') {
            $query->where('visit_date', now()->toDateString());
        } elseif ($period == 'weekly') {
            $query->where('visit_date', '>=', now()->subDays(7)->toDateString());
        } elseif ($period == 'monthly') {
            $query->where('visit_date', '>=', now()->subDays(30)->toDateString());
        }

        $stats = $query->groupBy('regions.name', 'visit_stats.page_type')->get();
        $regions = Region::where('status', true)->get();

        // Corrección del mapeo de vista a la carpeta web.admin
        return view('web.admin.stats.index', compact('stats', 'regions', 'period', 'regionId'));
    }
}