<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Region;
use Illuminate\Http\Request;

class ActivityApiController extends Controller
{
    public function index(Request $request, $regionSlug)
    {
        $region = Region::where('slug', $regionSlug)->firstOrFail();

        $query = Activity::whereHas('center', function ($q) use ($region) {
            $q->where('region_id', $region->id);
        })->with('center');

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('center_id')) {
            $query->where('center_id', $request->center_id);
        }

        $activities = $query->orderBy('start_datetime', 'asc')->get();

        return response()->json([
            'status' => 'success',
            'region' => $region->name,
            'total' => $activities->count(),
            'data' => $activities
        ], 200);
    }

    public function show($id)
    {
        $activity = Activity::with('center')->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $activity
        ], 200);
    }
}