<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Center;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CenterController extends Controller
{
    public function index()
    {
        $centers = Center::with('region')->orderBy('code')->paginate(15);
        return view('web.admin.centers.index', compact('centers'));
    }

    public function create()
    {
        $regions = Region::where('status', true)->get();
        return view('web.admin.centers.create', compact('regions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'region_id' => 'required|exists:regions,id',
            'code' => 'required|string|unique:centers,code',
            'type' => 'required|in:CAD_A,CAD_B,CAU',
            'name' => 'required|string|max:255',
            'province' => 'required|string',
            'district' => 'required|string',
            'locality' => 'required|string',
            'address' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'schedule' => 'nullable|string',
            'services' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'facebook_url' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:OPERATIVE,MAINTENANCE,INACTIVE',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('centers', 'public');
        }

        Center::create($validated);

        return redirect()->route('admin.centers.index')->with('success', 'Centro registrado exitosamente.');
    }

    public function edit(Center $center)
    {
        $regions = Region::where('status', true)->get();
        return view('web.admin.centers.edit', compact('center', 'regions'));
    }

    public function update(Request $request, Center $center)
    {
        $validated = $request->validate([
            'region_id' => 'required|exists:regions,id',
            'code' => 'required|string|unique:centers,code,' . $center->id,
            'type' => 'required|in:CAD_A,CAD_B,CAU',
            'name' => 'required|string|max:255',
            'province' => 'required|string',
            'district' => 'required|string',
            'locality' => 'required|string',
            'address' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'schedule' => 'nullable|string',
            'services' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'facebook_url' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:OPERATIVE,MAINTENANCE,INACTIVE',
        ]);

        if ($request->hasFile('image')) {
            if ($center->image_path) {
                Storage::disk('public')->delete($center->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('centers', 'public');
        }

        $center->update($validated);

        return redirect()->route('admin.centers.index')->with('success', 'Centro actualizado correctamente.');
    }

    public function destroy(Center $center)
    {
        if ($center->image_path) {
            Storage::disk('public')->delete($center->image_path);
        }
        $center->delete();

        return redirect()->route('admin.centers.index')->with('success', 'Centro eliminado correctamente.');
    }
}