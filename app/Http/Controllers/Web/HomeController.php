<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\Center;
use App\Models\Activity;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index($regionSlug = 'huanuco')
    {
        $region = Region::where('slug', $regionSlug)->firstOrFail();

        // Cifras destacadas exigidas por PRONATEL
        $stats = [
            'total_cad' => Center::where('region_id', $region->id)->where('type', '!=', 'CAU')->count(),
            'cad_a' => Center::where('region_id', $region->id)->where('type', 'CAD_A')->count(),
            'cad_b' => Center::where('region_id', $region->id)->where('type', 'CAD_B')->count(),
            'cau' => Center::where('region_id', $region->id)->where('type', 'CAU')->count(),
        ];

        // Próximas actividades registradas
        $upcomingActivities = Activity::whereHas('center', function($q) use ($region) {
            $q->where('region_id', $region->id);
        })->where('status', 'SCHEDULED')
          ->orderBy('start_datetime', 'asc')
          ->take(4)
          ->get();

        return view('web.home', compact('region', 'stats', 'upcomingActivities'));
    }

    public function aboutCad($regionSlug)
    {
        $region = Region::where('slug', $regionSlug)->firstOrFail();
        return view('web.about-cad', compact('region'));
    }

    public function sismos($regionSlug)
    {
        $region = Region::where('slug', $regionSlug)->firstOrFail();
        return view('web.sismos', compact('region'));
    }
}