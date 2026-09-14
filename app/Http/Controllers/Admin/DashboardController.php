<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Center;
use App\Models\Activity;
use App\Models\News;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $stats = [
            'total_centers' => Center::count(),
            'total_activities' => Activity::count(),
            'scheduled_activities' => Activity::where('status', 'SCHEDULED')->count(),
            'published_news' => News::where('status', 'PUBLISHED')->count(),
        ];

        // Datos para Gráfico 1: Centros por Tipo
        $centersByType = Center::select('type', DB::raw('count(*) as total'))
                               ->groupBy('type')
                               ->pluck('total', 'type')->toArray();

        // Datos para Gráfico 2: Actividades por Estado
        $activitiesByStatus = Activity::select('status', DB::raw('count(*) as total'))
                                      ->groupBy('status')
                                      ->pluck('total', 'status')->toArray();

        $recentActivities = Activity::with('center')->latest()->take(5)->get();

        return view('web.admin.dashboard', compact('user', 'stats', 'recentActivities', 'centersByType', 'activitiesByStatus'));
    }
}