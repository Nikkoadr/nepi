<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lembaga;
use App\Models\IzinLembaga;
use App\Models\KategoriPaud;
use Illuminate\Support\Facades\DB;

class PAUDController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Lembaga::with('izin')
            ->where('jenis_lembaga_id', 3) // PAUD
            ->latest()
            ->get();

        return view('paud.index', compact('data'));
    }

    public function create()
    {
        $kategori = KategoriPaud::all();
        return view('paud.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'npsn'          => 'required|unique:lembaga,npsn',
            'nama_lembaga'  => 'required',
            'pengelola'     => 'required',
            'alamat'        => 'required',
            'telepon'       => 'required',
            'kategori_id'   => 'required|exists:kategori_paud,id',
            'no_sertifikat' => 'nullable|string',
            'masa_berlaku'  => 'nullable|date',
            'jenis_izin'    => 'nullable|in:baru,perpanjangan,operasional',
            'status'        => 'nullable|in:aktif,habis,kadaluarsa',
            'keterangan'    => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {
            $lembaga = Lembaga::create([
                'npsn'             => $request->npsn,
                'nama_lembaga'     => $request->nama_lembaga,
                'pengelola'        => $request->pengelola,
                'alamat'           => $request->alamat,
                'telepon'          => $request->telepon,
                'jenis_lembaga_id' => 3,
                'kategori_id'      => $request->kategori_id,
            ]);

            if ($request->no_sertifikat || $request->masa_berlaku || $request->keterangan) {
                IzinLembaga::create([
                    'lembaga_id'    => $lembaga->id,
                    'no_sertifikat' => $request->no_sertifikat,
                    'masa_berlaku'  => $request->masa_berlaku,
                    'jenis_izin'    => $request->jenis_izin ?? 'baru',
                    'status'        => $request->status ?? 'aktif',
                    'keterangan'    => $request->keterangan,
                ]);
            }
        });

        return redirect()->route('paud.index')->with('success', 'Data PAUD berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $data = Lembaga::with('izin')->findOrFail($id);
        $kategori = KategoriPaud::all();
        return view('paud.show', compact('data', 'kategori'));
    }

    public function edit(string $id)
    {
        $data = Lembaga::with('izin')->findOrFail($id);
        $kategori = KategoriPaud::all();
        return view('paud.edit', compact('data', 'kategori'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'npsn'          => 'required|unique:lembaga,npsn,' . $id,
            'nama_lembaga'  => 'required',
            'pengelola'     => 'required',
            'alamat'        => 'required',
            'telepon'       => 'required',
            'kategori_paud_id' => 'required|exists:kategori_paud,id',
            'no_sertifikat' => 'nullable|string',
            'masa_berlaku'  => 'nullable|date',
            'keterangan'    => 'nullable|string',
            'status'        => 'nullable|in:aktif,habis,kadaluarsa',
            'jenis_izin'    => 'nullable|in:baru,perpanjangan,operasional,pendirian',
        ]);

        $lembaga = Lembaga::findOrFail($id);

        DB::transaction(function () use ($request, $lembaga) {
            $lembaga->update([
                'npsn'         => $request->npsn,
                'nama_lembaga' => $request->nama_lembaga,
                'pengelola'    => $request->pengelola,
                'alamat'       => $request->alamat,
                'telepon'      => $request->telepon,
                'kategori_paud_id' => $request->kategori_paud_id,
            ]);

            $lembaga->izin()->updateOrCreate(
                ['lembaga_id' => $lembaga->id],
                [
                    'no_sertifikat' => $request->no_sertifikat,
                    'masa_berlaku'  => $request->masa_berlaku,
                    'status'        => $request->status ?? 'aktif',
                    'jenis_izin'    => $request->jenis_izin ?? 'operasional',
                    'keterangan'    => $request->keterangan,
                ]
            );
        });

        return redirect()->route('paud.index')
            ->with('success', 'Data PAUD berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $lembaga = Lembaga::findOrFail($id);

        $lembaga->delete();

        return redirect()->route('paud.index')
            ->with('success', 'Data PAUD berhasil dihapus');
    }
}