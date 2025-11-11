<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGaleriFotoRequest;
use App\Http\Requests\UpdateGaleriFotoRequest;
use App\Models\GaleriFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GaleriFotoController extends Controller
{
    public function __construct()
    {
        // contoh: batasi create/store/update/destroy ke user login
        $this->middleware('auth')->except(['publicIndex','publicShow']);
    }

    /**
     * GET /dashboard/galeri-foto
     * List + cari + paginate (area admin)
     */
    public function index(Request $request)
    {
        $q = $request->input('q');
        $items = GaleriFoto::query()
            ->when($q, fn($query) =>
                $query->where('judul','like',"%{$q}%")
                      ->orWhere('tanggal','like',"%{$q}%")
            )
            ->orderByDesc('tanggal')
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();

        return view('dashboard.galeri_foto.index', [
            'items' => $items,
            'q' => $q,
        ]);
    }

    /**
     * GET /dashboard/galeri-foto/create
     */
    public function create()
    {
        return view('dashboard.galeri_foto.create');
    }

    /**
     * POST /dashboard/galeri-foto
     * Simpan + upload file
     */
    public function store(StoreGaleriFotoRequest $request)
    {
        $data = $request->validated();

        // simpan file ke storage/app/public/galeri
        $path = $request->file('gambar')->storeAs(
            'galeri',
            now()->format('Ymd_His').'-'.Str::slug($data['judul']).'.'.$request->file('gambar')->extension(),
            'public'
        );

        GaleriFoto::create([
            'judul'       => $data['judul'],
            'tanggal'     => $data['tanggal'],
            'gambar_path' => $path,
        ]);

        return redirect()
            ->route('dashboard.galeri-foto.index')
            ->with('success', 'Foto berhasil ditambahkan.');
    }

    /**
     * GET /dashboard/galeri-foto/{galeri_foto}
     */
    public function show(GaleriFoto $galeri_foto)
    {
        return view('dashboard.galeri_foto.show', ['item' => $galeri_foto]);
    }

    /**
     * Alias "detail" (opsional)
     */
    public function detail(GaleriFoto $galeri_foto)
    {
        return $this->show($galeri_foto);
    }

    /**
     * GET /dashboard/galeri-foto/{galeri_foto}/edit
     */
    public function edit(GaleriFoto $galeri_foto)
    {
        return view('dashboard.galeri_foto.edit', ['item' => $galeri_foto]);
    }

    /**
     * PUT/PATCH /dashboard/galeri-foto/{galeri_foto}
     * Update + ganti file (hapus lama)
     */
    public function update(UpdateGaleriFotoRequest $request, GaleriFoto $galeri_foto)
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            // hapus file lama jika ada
            if ($galeri_foto->gambar_path && Storage::disk('public')->exists($galeri_foto->gambar_path)) {
                Storage::disk('public')->delete($galeri_foto->gambar_path);
            }
            $newPath = $request->file('gambar')->storeAs(
                'galeri',
                now()->format('Ymd_His').'-'.Str::slug($data['judul'] ?? $galeri_foto->judul).'.'.$request->file('gambar')->extension(),
                'public'
            );
            $data['gambar_path'] = $newPath;
        }

        $galeri_foto->update($data);

        return redirect()
            ->route('dashboard.galeri-foto.index')
            ->with('success', 'Foto berhasil diperbarui.');
    }

    /**
     * DELETE /dashboard/galeri-foto/{galeri_foto}
     * Hapus data + file
     */
    public function destroy(GaleriFoto $galeri_foto)
    {
        if ($galeri_foto->gambar_path && Storage::disk('public')->exists($galeri_foto->gambar_path)) {
            Storage::disk('public')->delete($galeri_foto->gambar_path);
        }
        $galeri_foto->delete();

        return redirect()
            ->route('dashboard.galeri-foto.index')
            ->with('success', 'Foto berhasil dihapus.');
    }

    /**
     * (Opsional) Halaman publik daftar & detail
     */
    public function publicIndex()
    {
        $items = GaleriFoto::orderByDesc('tanggal')->paginate(20);
        return view('galeri.index', ['items' => $items]);
    }

    public function publicShow(GaleriFoto $galeri_foto)
    {
        return view('galeri.show', ['item' => $galeri_foto]);
    }
}
