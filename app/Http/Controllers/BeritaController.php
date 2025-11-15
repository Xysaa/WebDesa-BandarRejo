<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    /**
     * Display a listing for dashboard.
     */
    public function index()
    {
        $beritas = Berita::latest()->paginate(10);
        return view('dashboard.berita', compact('beritas'));
    }

    /**
     * Display a listing for public page.
     */
    public function indexPublic()
    {
        $berita = Berita::latest()->get();
        return view('berita', compact('berita'));
    }

    public function create()
    {
        return view('dashboard.berita-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'isi' => 'required|string',
            'author' => 'required|string|max:255',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'slug' => 'nullable|string|max:255|unique:beritas,slug'
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('berita', 'public');
        }

        Berita::create($validated);

        return redirect()->route('dashboard.berita.index')
            ->with('success', 'Berita berhasil ditambahkan');
    }

    /**
     * Display the specified resource by slug.
     */
    public function show($slug)
    {
        $artikel = Berita::where('slug', $slug)->firstOrFail();
        
        // Increment views dengan session tracking
        if (!session()->has('viewed_berita_' . $artikel->id)) {
            $artikel->incrementViews();
            session()->put('viewed_berita_' . $artikel->id, true);
        }

        // Get all berita untuk sidebar
        $berita = Berita::latest()->limit(6)->get();

        return view('detail', compact('artikel', 'berita'));
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('dashboard.berita-edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'isi' => 'required|string',
            'author' => 'required|string|max:255',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'slug' => 'nullable|string|max:255|unique:beritas,slug,' . $berita->id
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('image')) {
            if ($berita->image) {
                Storage::disk('public')->delete($berita->image);
            }
            $validated['image'] = $request->file('image')->store('berita', 'public');
        }

        $berita->update($validated);

        return redirect()->route('dashboard.berita.index')
            ->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->image) {
            Storage::disk('public')->delete($berita->image);
        }

        $berita->delete();

        return redirect()->route('dashboard.berita.index')
            ->with('success', 'Berita berhasil dihapus');
    }
}
