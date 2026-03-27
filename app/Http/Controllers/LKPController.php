<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lembaga;
use App\Models\IzinLembaga;
use Illuminate\Support\Facades\DB;

class LKPController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Lembaga::with('izin')
            ->where('jenis_lembaga_id', 2) // LKP
            ->latest()
            ->get();

        return view('lkp.index', compact('data'));
    }

    public function create()
    {
        return view('lkp.create');
    }

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

        DB::transaction(function () use ($request) {
            $lembaga = Lembaga::create([
                'npsn'             => $request->npsn,
                'nama_lembaga'     => $request->nama_lembaga,
                'pengelola'        => $request->pengelola,
                'alamat'           => $request->alamat,
                'telepon'          => $request->telepon,
                'jenis_lembaga_id' => 2,
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

        return redirect()->route('lkp.index')->with('success', 'Data LKP berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $data = Lembaga::with('izin')->findOrFail($id);
        return view('lkp.show', compact('data'));
    }

    public function edit(string $id)
    {

        $data = Lembaga::with('izin')->findOrFail($id);
        return view('lkp.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'npsn'          => 'required|unique:lembaga,npsn,' . $id,
            'nama_lembaga'  => 'required',
            'pengelola'     => 'required',
            'alamat'        => 'required',
            'telepon'       => 'required',
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

        return redirect()->route('lkp.index')
            ->with('success', 'Data LKP berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $lembaga = Lembaga::findOrFail($id);

        $lembaga->delete();

        return redirect()->route('lkp.index')
            ->with('success', 'Data LKP berhasil dihapus');
    }
}