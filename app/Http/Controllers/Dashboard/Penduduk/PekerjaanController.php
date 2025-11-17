<?php

namespace App\Http\Controllers\Dashboard\Penduduk;

use App\Http\Controllers\Controller;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class PekerjaanController extends Controller
{
    public function index()
    {
        $pekerjaans = Pekerjaan::orderBy('nama_pekerjaan')->paginate(10);

        return view('dashboard.pekerjaan', compact('pekerjaans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pekerjaan'   => ['required', 'string', 'max:255'],
            'bidang_pekerjaan' => ['required', 'string', 'max:255'],
        ]);

        Pekerjaan::create($validated);

        return redirect()
            ->route('dashboard.pekerjaan.index')
            ->with('success', 'Pekerjaan berhasil ditambahkan.');
    }

    public function update(Request $request, Pekerjaan $pekerjaan)
    {
        $validated = $request->validate([
            'nama_pekerjaan'   => ['required', 'string', 'max:255'],
            'bidang_pekerjaan' => ['required', 'string', 'max:255'],
        ]);

        $pekerjaan->update($validated);

        return redirect()
            ->route('dashboard.pekerjaan.index')
            ->with('success', 'Pekerjaan berhasil diperbarui.');
    }

    public function destroy(Pekerjaan $pekerjaan)
    {
        $pekerjaan->delete();

        return redirect()
            ->route('dashboard.pekerjaan.index')
            ->with('success', 'Pekerjaan berhasil dihapus.');
    }
}
