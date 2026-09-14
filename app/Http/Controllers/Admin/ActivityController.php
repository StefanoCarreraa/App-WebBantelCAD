<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityEvidence;
use App\Models\Center;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->input('search'));
        $activities = Activity::with(['center', 'evidences'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('category', 'like', "%{$search}%")
                        ->orWhere('activity_type', 'like', "%{$search}%")
                        ->orWhere('target_audience', 'like', "%{$search}%")
                        ->orWhere('responsable_name', 'like', "%{$search}%")
                        ->orWhere('status', 'like', "%{$search}%")
                        ->orWhereHas('center', function ($query) use ($search) {
                            $query->where('code', 'like', "%{$search}%")
                                ->orWhere('name', 'like', "%{$search}%");
                        });
                });
            })
            ->orderBy('start_datetime', 'desc')
            ->paginate(12)
            ->withQueryString();

        return view('web.admin.actividades.index', compact('activities'));
    }

    public function create()
    {
        $centers = Center::orderBy('name')->get();
        return view('web.admin.actividades.create', compact('centers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'center_id'        => 'required|exists:centros,id',
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'start_datetime'   => 'required|date',
            'end_datetime'     => 'nullable|date|after_or_equal:start_datetime',
            'status'           => 'required|in:SCHEDULED,COMPLETED,RESCHEDULED,CANCELED',
            'responsable_name' => 'nullable|string|max:255',
            'attendees_count'  => 'nullable|integer|min:0',
            'evidences.*'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $activity = Activity::create($validated);

        if ($request->hasFile('evidences')) {
            foreach ($request->file('evidences') as $file) {
                $path = $file->store('activities/evidences', 'public');
                $activity->evidences()->create([
                    'file_path' => $path,
                    'file_type' => 'image',
                ]);
            }
        }

        return redirect()->route('admin.actividades.index')
            ->with('success', 'Actividad y sus registros guardados exitosamente.');
    }

    public function edit(Activity $activity)
    {
        $activity->load('evidences', 'center');
        $centers = Center::orderBy('name')->get();
        return view('web.admin.actividades.edit', compact('activity', 'centers'));
    }

    public function update(Request $request, Activity $activity)
    {
        $validated = $request->validate([
            'center_id'        => 'required|exists:centros,id',
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'start_datetime'   => 'required|date',
            'end_datetime'     => 'nullable|date|after_or_equal:start_datetime',
            'status'           => 'required|in:SCHEDULED,COMPLETED,RESCHEDULED,CANCELED',
            'responsable_name' => 'nullable|string|max:255',
            'attendees_count'  => 'nullable|integer|min:0',
            'evidences.*'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $activity->update($validated);

        if ($request->hasFile('evidences')) {
            foreach ($request->file('evidences') as $file) {
                $path = $file->store('activities/evidences', 'public');
                $activity->evidences()->create([
                    'file_path' => $path,
                    'file_type' => 'image',
                ]);
            }
        }

        return redirect()->route('admin.actividades.index')
            ->with('success', 'Actividad actualizada correctamente.');
    }

    public function destroy(Activity $activity)
    {
        foreach ($activity->evidences as $evidence) {
            Storage::disk('public')->delete($evidence->file_path);
        }
        $activity->delete();

        return redirect()->route('admin.actividades.index')
            ->with('success', 'Actividad eliminada correctamente.');
    }

    public function destroyEvidence(ActivityEvidence $evidence)
    {
        Storage::disk('public')->delete($evidence->file_path);
        $evidence->delete();

        return redirect()->back()->with('success', 'Evidencia eliminada.');
    }
}