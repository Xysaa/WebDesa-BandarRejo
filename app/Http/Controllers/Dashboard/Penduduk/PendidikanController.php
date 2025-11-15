<?php
namespace App\Http\Controllers\Dashboard\Penduduk;

use App\Http\Controllers\Controller;
use App\Models\Pendidikan;
use Illuminate\Http\Request;

class PendidikanController extends Controller
{
    public function index()
    {
        $pendidikans = Pendidikan::all();
        return response()->json($pendidikans);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_pendidikan' => 'required|string|max:100|unique:pendidikans,jenis_pendidikan',
        ]);

        $data = Pendidikan::create($validated);
        return response()->json([
            'message' => 'Data pendidikan berhasil ditambahkan',
            'data' => $data
        ]);
    }

    public function show(Pendidikan $pendidikan)
    {
        return response()->json($pendidikan);
    }

    public function update(Request $request, Pendidikan $pendidikan)
    {
        $validated = $request->validate([
            'jenis_pendidikan' => 'required|string|max:100|unique:pendidikans,jenis_pendidikan,' . $pendidikan->id,
        ]);

        $pendidikan->update($validated);

        return response()->json([
            'message' => 'Data pendidikan berhasil diperbarui',
            'data' => $pendidikan
        ]);
    }

    public function destroy(Pendidikan $pendidikan)
    {
        $pendidikan->delete();
        return response()->json(['message' => 'Data pendidikan berhasil dihapus']);
    }
}
