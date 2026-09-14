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
    public function index()
    {
        $activities = Activity::with(['center', 'evidences'])
            ->orderBy('start_datetime', 'desc')
            ->paginate(12);

        return view('web.admin.activities.index', compact('activities'));
    }

    public function create()
    {
        $centers = Center::orderBy('name')->get();
        return view('web.admin.activities.create', compact('centers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'center_id'        => 'required|exists:centers,id',
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'start_datetime'   => 'required|date',
            'end_datetime'     => 'nullable|date|after_or_equal:start_datetime',
            'status'           => 'required|in:SCHEDULED,COMPLETED,RESCHEDULED,CANCELLED',
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

        return redirect()->route('admin.activities.index')
            ->with('success', 'Actividad y sus registros guardados exitosamente.');
    }

    public function edit(Activity $activity)
    {
        $activity->load('evidences', 'center');
        $centers = Center::orderBy('name')->get();
        return view('web.admin.activities.edit', compact('activity', 'centers'));
    }

    public function update(Request $request, Activity $activity)
    {
        $validated = $request->validate([
            'center_id'        => 'required|exists:centers,id',
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'start_datetime'   => 'required|date',
            'end_datetime'     => 'nullable|date|after_or_equal:start_datetime',
            'status'           => 'required|in:SCHEDULED,COMPLETED,RESCHEDULED,CANCELLED',
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

        return redirect()->route('admin.activities.index')
            ->with('success', 'Actividad actualizada correctamente.');
    }

    public function destroy(Activity $activity)
    {
        foreach ($activity->evidences as $evidence) {
            Storage::disk('public')->delete($evidence->file_path);
        }
        $activity->delete();

        return redirect()->route('admin.activities.index')
            ->with('success', 'Actividad eliminada correctamente.');
    }

    public function destroyEvidence(ActivityEvidence $evidence)
    {
        Storage::disk('public')->delete($evidence->file_path);
        $evidence->delete();

        return redirect()->back()->with('success', 'Evidencia eliminada.');
    }
}