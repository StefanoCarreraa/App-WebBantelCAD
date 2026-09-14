<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Region;

class ResourceController extends Controller
{
    public function index()
    {
        $resources = DB::table('digital_resources')
            ->join('regions', 'digital_resources.region_id', '=', 'regions.id')
            ->select('digital_resources.*', 'regions.name as region_name')
            ->orderBy('digital_resources.created_at', 'desc')
            ->paginate(10);

        return view('web.admin.resources.index', compact('resources'));
    }

    public function create()
    {
        $regions = Region::where('status', true)->get();
        return view('web.admin.resources.create', compact('regions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'region_id' => 'required|exists:regions,id',
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
            'external_url' => 'nullable|url',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('resources', 'public');
        }

        DB::table('digital_resources')->insert([
            'region_id' => $validated['region_id'],
            'title' => $validated['title'],
            'category' => $validated['category'],
            'file_path' => $filePath,
            'external_url' => $validated['external_url'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('web.admin.resources.index')->with('success', 'Recurso guardado correctamente.');
    }

    public function destroy($id)
    {
        DB::table('digital_resources')->where('id', $id)->delete();
        return redirect()->route('web.admin.resources.index')->with('success', 'Recurso eliminado.');
    }
}
