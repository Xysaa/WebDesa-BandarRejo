<?php

namespace App\Http\Controllers;

use App\Models\PotensiDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PotensiDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $potensiDesas = PotensiDesa::latest()->paginate(10);
        return view('dashboard.potensi', compact('potensiDesas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.potensi-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_potensi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('potensi', 'public');
        }

        PotensiDesa::create($validated);

        return redirect()->route('dashboard.potensi.index')
            ->with('success', 'Potensi desa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(PotensiDesa $potensiDesa)
    {
        return view('potensi.show', compact('potensiDesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $potensiDesa = PotensiDesa::findOrFail($id);
        return view('dashboard.potensi-edit', compact('potensiDesa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $potensiDesa = PotensiDesa::findOrFail($id);
        
        $validated = $request->validate([
            'judul_potensi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Upload gambar baru jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($potensiDesa->gambar) {
                Storage::disk('public')->delete($potensiDesa->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('potensi', 'public');
        }

        $potensiDesa->update($validated);

        return redirect()->route('dashboard.potensi.index')
            ->with('success', 'Potensi desa berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $potensiDesa = PotensiDesa::findOrFail($id);
        
        // Hapus gambar jika ada
        if ($potensiDesa->gambar) {
            Storage::disk('public')->delete($potensiDesa->gambar);
        }

        $potensiDesa->delete();

        return redirect()->route('dashboard.potensi.index')
            ->with('success', 'Potensi desa berhasil dihapus');
    }
}
