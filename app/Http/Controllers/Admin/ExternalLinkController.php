<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExternalLink;
use App\Models\Region;
use Illuminate\Http\Request;

class ExternalLinkController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->input('search'));
        $links = ExternalLink::with('region')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('category', 'like', "%{$search}%")
                        ->orWhere('url', 'like', "%{$search}%")
                        ->orWhereHas('region', function ($query) use ($search) {
                            $query->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();
        $regions = Region::where('status', true)->get();

        return view('web.admin.enlaces_externos.index', compact('links', 'regions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'region_id' => 'required|exists:regiones,id',
            'category'  => 'required|string|max:100',
            'title'     => 'required|string|max:255',
            'url'       => 'required|url|max:500',
        ]);

        ExternalLink::create($data);

        return redirect()->back()->with('success', 'Enlace externo registrado con éxito.');
    }

    public function destroy(ExternalLink $externalLink)
    {
        $externalLink->delete();

        return redirect()->back()->with('success', 'Enlace externo eliminado.');
    }
}