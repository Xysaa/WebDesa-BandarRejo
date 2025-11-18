<?php

namespace App\Http\Controllers;

use App\Models\DataStunting;
use Illuminate\Http\Request;

class DataStuntingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataStuntings = DataStunting::latest()->paginate(10);
        return view('dashboard.stunting', compact('dataStuntings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.stunting-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_dusun' => 'required|string|max:255',
            'jumlah_anak_stunting' => 'required|integer|min:0',
            'tahun' => 'nullable|digits:4|integer|min:2000|max:' . (date('Y') + 1),
            'keterangan' => 'nullable|string'
        ], [
            'nama_dusun.required' => 'Nama dusun wajib diisi',
            'jumlah_anak_stunting.required' => 'Jumlah anak stunting wajib diisi',
            'jumlah_anak_stunting.integer' => 'Jumlah anak stunting harus berupa angka',
            'jumlah_anak_stunting.min' => 'Jumlah anak stunting tidak boleh kurang dari 0'
        ]);

        DataStunting::create($validated);

        return redirect()->route('dashboard.stunting.index')
            ->with('success', 'Data stunting berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    // public function show(DataStunting $dataStunting)
    // {
    //     return view('dashboard.stunting-show', compact('dataStunting'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataStunting $dataStunting)
    {
        return view('dashboard.stunting-edit', compact('dataStunting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataStunting $dataStunting)
    {
        $validated = $request->validate([
            'nama_dusun' => 'required|string|max:255',
            'jumlah_anak_stunting' => 'required|integer|min:0',
            'tahun' => 'nullable|digits:4|integer|min:2000|max:' . (date('Y') + 1),
            'keterangan' => 'nullable|string'
        ], [
            'nama_dusun.required' => 'Nama dusun wajib diisi',
            'jumlah_anak_stunting.required' => 'Jumlah anak stunting wajib diisi',
            'jumlah_anak_stunting.integer' => 'Jumlah anak stunting harus berupa angka',
            'jumlah_anak_stunting.min' => 'Jumlah anak stunting tidak boleh kurang dari 0'
        ]);

        $dataStunting->update($validated);

        return redirect()->route('dashboard.stunting.index')
            ->with('success', 'Data stunting berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataStunting $dataStunting)
    {
        $dataStunting->delete();

        return redirect()->route('dashboard.stunting.index')
            ->with('success', 'Data stunting berhasil dihapus');
    }
}
