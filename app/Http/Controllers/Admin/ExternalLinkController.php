<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExternalLink;
use App\Models\Region;
use Illuminate\Http\Request;

class ExternalLinkController extends Controller
{
    public function index()
    {
        $links = ExternalLink::with('region')->latest()->paginate(15);
        $regions = Region::where('status', true)->get();

        return view('web.admin.external_links.index', compact('links', 'regions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'region_id' => 'required|exists:regions,id',
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