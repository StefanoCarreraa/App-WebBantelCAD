<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Region;

class ResourceController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->input('search'));
        $resources = DB::table('recursos_digitales')
            ->join('regiones', 'recursos_digitales.region_id', '=', 'regiones.id')
            ->select('recursos_digitales.*', 'regiones.name as region_name')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('recursos_digitales.title', 'like', "%{$search}%")
                        ->orWhere('recursos_digitales.category', 'like', "%{$search}%")
                        ->orWhere('recursos_digitales.file_path', 'like', "%{$search}%")
                        ->orWhere('recursos_digitales.external_url', 'like', "%{$search}%")
                        ->orWhere('regiones.name', 'like', "%{$search}%");
                });
            })
            ->orderBy('recursos_digitales.created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('web.admin.recursos.index', compact('resources'));
    }

    public function create()
    {
        $regions = Region::where('status', true)->get();
        return view('web.admin.recursos.create', compact('regions'));
    }

    public function edit($id)
    {
        $resource = DB::table('recursos_digitales')->where('id', $id)->firstOrFail();
        $regions = Region::where('status', true)->get();

        return view('web.admin.recursos.create', compact('resource', 'regions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'region_id' => 'required|exists:regiones,id',
            'title' => 'required|string|max:255',
            'file_type' => 'required|in:PDF,DOCX,XLSX,LINK',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
            'external_url' => 'nullable|url',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('resources', 'public');
        }

        DB::table('recursos_digitales')->insert([
            'region_id' => $validated['region_id'],
            'title' => $validated['title'],
            'category' => $validated['file_type'],
            'file_path' => $filePath,
            'external_url' => $validated['external_url'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.recursos.index')->with('success', 'Recurso guardado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'region_id' => 'required|exists:regiones,id',
            'title' => 'required|string|max:255',
            'file_type' => 'required|in:PDF,DOCX,XLSX,LINK',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
            'external_url' => 'nullable|url',
        ]);

        $resource = DB::table('recursos_digitales')->where('id', $id)->firstOrFail();
        $filePath = $resource->file_path;

        if ($request->hasFile('file')) {
            if ($filePath) {
                Storage::disk('public')->delete($filePath);
            }

            $filePath = $request->file('file')->store('resources', 'public');
        }

        DB::table('recursos_digitales')->where('id', $id)->update([
            'region_id' => $validated['region_id'],
            'title' => $validated['title'],
            'category' => $validated['file_type'],
            'file_path' => $filePath,
            'external_url' => $validated['external_url'] ?? null,
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.recursos.index')->with('success', 'Recurso actualizado correctamente.');
    }

    public function destroy($id)
    {
        $resource = DB::table('recursos_digitales')->where('id', $id)->firstOrFail();

        if ($resource->file_path) {
            Storage::disk('public')->delete($resource->file_path);
        }

        DB::table('recursos_digitales')->where('id', $id)->delete();
        return redirect()->route('admin.recursos.index')->with('success', 'Recurso eliminado.');
    }
}
