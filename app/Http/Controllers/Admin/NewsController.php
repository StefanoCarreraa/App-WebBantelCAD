<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Region;
use App\Models\Center;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->input('search'));
        $news = News::with('region')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%")
                        ->orWhere('summary', 'like', "%{$search}%")
                        ->orWhere('content', 'like', "%{$search}%")
                        ->orWhere('status', 'like', "%{$search}%")
                        ->orWhereHas('region', function ($query) use ($search) {
                            $query->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->orderBy('published_at', 'desc')
            ->paginate(10)
            ->withQueryString();
        return view('web.admin.noticias.index', compact('news'));
    }

    public function create()
    {
        $regions = Region::where('status', true)->get();
        $centers = Center::orderBy('name')->get();
        return view('web.admin.noticias.create', compact('regions', 'centers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'region_id'  => 'required|exists:regiones,id',
            'center_id'  => 'nullable|exists:centros,id',
            'title'      => 'required|string|max:255',
            'summary'    => 'required|string|max:500',
            'content'    => 'required|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status'     => 'required|in:DRAFT,PUBLISHED,ARCHIVED',
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . uniqid();
        
        if ($validated['status'] === 'PUBLISHED') {
            $validated['published_at'] = now();
        }

        if ($request->hasFile('main_image')) {
            $validated['main_image'] = $request->file('main_image')->store('news', 'public');
        }

        News::create($validated);

        return redirect()->route('admin.noticias.index')->with('success', 'Noticia publicada correctamente.');
    }

    public function edit(News $news)
    {
        $regions = Region::where('status', true)->get();
        $centers = Center::orderBy('name')->get();
        return view('web.admin.noticias.edit', compact('news', 'regions', 'centers'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'region_id'  => 'required|exists:regiones,id',
            'center_id'  => 'nullable|exists:centros,id',
            'title'      => 'required|string|max:255',
            'summary'    => 'required|string|max:500',
            'content'    => 'required|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status'     => 'required|in:DRAFT,PUBLISHED,ARCHIVED',
        ]);

        if ($validated['title'] !== $news->title) {
            $validated['slug'] = Str::slug($validated['title']) . '-' . uniqid();
        }

        if ($validated['status'] === 'PUBLISHED' && !$news->published_at) {
            $validated['published_at'] = now();
        }

        if ($request->hasFile('main_image')) {
            if ($news->main_image) {
                Storage::disk('public')->delete($news->main_image);
            }
            $validated['main_image'] = $request->file('main_image')->store('news', 'public');
        }

        $news->update($validated);

        return redirect()->route('admin.noticias.index')->with('success', 'Noticia actualizada con éxito.');
    }

    public function destroy(News $news)
    {
        if ($news->main_image) {
            Storage::disk('public')->delete($news->main_image);
        }
        $news->delete();

        return redirect()->route('admin.noticias.index')->with('success', 'Noticia eliminada correctamente.');
    }
}