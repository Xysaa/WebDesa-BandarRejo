<?php

namespace App\Http\Controllers;

use App\Models\Bansos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BansosController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q');

        $items = Bansos::query()
            ->when($q, function ($query) use ($q) {
                $query->where('jenis_bansos', 'like', "%{$q}%")
                      ->orWhere('satuan', 'like', "%{$q}%");
            })
            ->orderBy('jenis_bansos')
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('dashboard.bansos', [
            'items' => $items,
            'q'     => $q,
        ]);
    }

    public function create()
    {
        return view('dashboard.bansos-create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'jenis_bansos' => ['required', 'string', 'max:150'],
            'jumlah'       => ['required', 'integer', 'min:0'],
            'satuan'       => ['required', 'string', 'max:50'],
        ]);

        Bansos::create($data);

        return redirect()
            ->route('dashboard.bansos.index')
            ->with('success', 'Data bansos berhasil ditambahkan.');
    }

    public function show(Bansos $bansos)
    {
        return view('dashboard.bansos_show', [
            'item' => $bansos,
        ]);
    }

    public function detail(Bansos $bansos)
    {
        return $this->show($bansos);
    }

    public function edit(Bansos $bansos)
    {
        return view('dashboard.bansos-edit', [
            'item' => $bansos,
        ]);
    }

    public function update(Request $request, Bansos $bansos)
    {
        $data = $request->validate([
            'jenis_bansos' => ['required', 'string', 'max:150'],
            'jumlah'       => ['required', 'integer', 'min:0'],
            'satuan'       => ['required', 'string', 'max:50'],
        ]);

        $bansos->update($data);

        return redirect()
            ->route('dashboard.bansos.index')
            ->with('success', 'Data bansos berhasil diperbarui.');
    }

    public function destroy(Bansos $bansos)
    {
        // kalau mau debug, boleh tes dulu:
        // dd('masuk destroy', $bansos->id);

        DB::table('bansos')
            ->where('id', $bansos->id)
            ->delete();

        return redirect()
            ->route('dashboard.bansos.index')
            ->with('success', 'Data bansos berhasil dihapus.');
    }
}
