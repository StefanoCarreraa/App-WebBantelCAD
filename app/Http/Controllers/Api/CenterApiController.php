<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Center;
use App\Models\Region;
use Illuminate\Http\Request;

class CenterApiController extends Controller
{
    public function index(Request $request, $regionSlug)
    {
        $region = Region::where('slug', $regionSlug)->firstOrFail();

        $query = Center::where('region_id', $region->id);

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        if ($request->has('province')) {
            $query->where('province', $request->province);
        }

        if ($request->has('district')) {
            $query->where('district', $request->district);
        }

        return response()->json([
            'status' => 'success',
            'region' => $region->name,
            'total' => $query->count(),
            'data' => $query->get()
        ], 200);
    }

    public function show($code)
    {
        $center = Center::where('code', $code)->with('activities')->firstOrFail();

        return response()->json([
            'status' => 'success',
            'data' => $center
        ], 200);
    }
}