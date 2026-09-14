<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Center;
use Illuminate\Support\Facades\DB;

class TrackVisitStats
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($request->isMethod('get') && $request->route('region')) {
            $regionSlug = $request->route('region');
            $region = Region::where('slug', $regionSlug)->first();

            if ($region) {
                $pageType = strtoupper($request->route()->getName() ?? 'HOME');
                
                // Obtener el ID numérico del centro si la ruta contiene el parámetro 'code'
                $centerId = null;
                $centerCode = $request->route('code');
                
                if ($centerCode) {
                    $centerId = Center::where('region_id', $region->id)
                        ->where('code', $centerCode)
                        ->value('id');
                }

                DB::table('visit_stats')->updateOrInsert(
                    [
                        'region_id' => $region->id,
                        'page_type' => $pageType,
                        'center_id' => $centerId, // Ahora pasa un número ID o NULL
                        'visit_date' => now()->toDateString(),
                    ],
                    [
                        'views_count' => DB::raw('views_count + 1'),
                        'updated_at' => now(),
                    ]
                );
            }
        }

        return $response;
    }
}