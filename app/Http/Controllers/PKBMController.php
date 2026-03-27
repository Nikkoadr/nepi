<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lembaga;
use App\Models\IzinLembaga;

class PKBMController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display list PKBM
     */
    public function index()
    {
        $data = Lembaga::with('izin')
            ->where('jenis_lembaga_id', 1) // PKBM
            ->latest()
            ->get();

        return view('pkbm.index', compact('data'));
    }

    /**
     * Form tambah
     */
    public function create()
    {
        return view('pkbm.create');
    }

    /**
     * Simpan data
     */
public function store(Request $request)
{
    $request->validate([
        'npsn'          => 'required|unique:lembaga,npsn',
        'nama_lembaga'  => 'required',
        'pengelola'     => 'required',
        'alamat'        => 'required',
        'telepon'       => 'required',
        'no_sertifikat' => 'nullable|string',
        'masa_berlaku'  => 'nullable|date',
        'jenis_izin'    => 'nullable|in:baru,perpanjangan,operasional',
        'status'        => 'nullable|in:aktif,habis,kadaluarsa',
        'keterangan'    => 'nullable|string',
    ]);

    
    $lembaga = Lembaga::create([
        'npsn'             => $request->npsn,
        'nama_lembaga'     => $request->nama_lembaga,
        'pengelola'        => $request->pengelola,
        'alamat'           => $request->alamat,
        'telepon'          => $request->telepon,
        'jenis_lembaga_id' => 1,
        'keterangan'       => $request->keterangan
    ]);

    if ($request->no_sertifikat || $request->masa_berlaku) {
        IzinLembaga::create([
            'lembaga_id'    => $lembaga->id,
            'no_sertifikat' => $request->no_sertifikat,
            'masa_berlaku'  => $request->masa_berlaku,
            'jenis_izin'    => $request->jenis_izin ?? 'baru',
            'status'        => $request->status ?? 'aktif',
            'keterangan'    => $request->keterangan,
        ]);
    }

    return redirect()->route('pkbm.index')->with('success', 'Data PKBM berhasil ditambahkan');
}
    /**
     * Detail (optional)
     */
    public function show(string $id)
    {
        $data = Lembaga::with('izin')->findOrFail($id);
        return view('pkbm.show', compact('data'));
    }

    /**
     * Form edit
     */
    public function edit(string $id)
    {
        // Pastikan nama relasi di model adalah 'izin'
        $data = Lembaga::with('izin')->findOrFail($id);
        return view('pkbm.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'npsn'          => 'required|unique:lembaga,npsn,' . $id,
            'nama_lembaga'  => 'required', // Samakan dengan name di input Blade
            'pengelola'     => 'required',
            'alamat'        => 'required',
            'telepon'       => 'required',
            'status'        => 'nullable|in:aktif,habis,kadaluarsa',
            'jenis_izin'    => 'nullable|in:baru,perpanjangan,operasional,pendirian',
        ]);

        $lembaga = Lembaga::findOrFail($id);

        // Update data Lembaga
        $lembaga->update([
            'npsn'         => $request->npsn,
            'nama_lembaga' => $request->nama_lembaga, // Gunakan nama_lembaga
            'pengelola'    => $request->pengelola,
            'alamat'       => $request->alamat,
            'telepon'      => $request->telepon,
        ]);

        // Update atau Create Izin menggunakan updateOrCreate agar lebih ringkas
        $lembaga->izin()->updateOrCreate(
            ['lembaga_id' => $lembaga->id], // Key pencarian
            [
                'no_sertifikat' => $request->no_sertifikat,
                'masa_berlaku'  => $request->masa_berlaku,
                'status'        => $request->status ?? 'aktif',
                'jenis_izin'    => $request->jenis_izin ?? 'operasional',
                'keterangan'    => $request->keterangan,
            ]
        );

        return redirect()->route('pkbm.index')
            ->with('success', 'Data PKBM berhasil diupdate');
    }

    /**
     * Hapus data
     */
    public function destroy(string $id)
    {
        $lembaga = Lembaga::findOrFail($id);

        // hapus izin dulu
        if ($lembaga->izin) {
            $lembaga->izin->delete();
        }

        $lembaga->delete();

        return redirect()->route('pkbm.index')
            ->with('success', 'Data PKBM berhasil dihapus');
    }
}