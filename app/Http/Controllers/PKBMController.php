<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lembaga;
use App\Models\IzinLembaga;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PKBMController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $today = Carbon::today();

        $data = Lembaga::with('izin')
            ->where('jenis_lembaga_id', 1)
            ->latest()
            ->get()
            ->map(function ($item) use ($today) {
                if (!$item->izin || !$item->izin->masa_berlaku) {
                    $item->status_teks = "Data Izin Tidak Ada";
                    $item->status_label = "secondary";
                    return $item;
                }

                $masaBerlaku = Carbon::parse($item->izin->masa_berlaku);

                if ($masaBerlaku->isPast()) {
                    $item->status_teks = "Kadaluarsa";
                    $item->status_label = "danger";
                } else {
                    $sisaHari = $today->diffInDays($masaBerlaku, false);

                    if ($sisaHari <= 30) {
                        $item->status_teks = "Masa berlaku kurang dari " . $sisaHari . " hari";
                        $item->status_label = "warning";
                    } else {

                        $item->status_teks = "Aktif";
                        $item->status_label = "success";
                    }
                }

                return $item;
            });

        return view('pkbm.index', compact('data'));
    }

    public function create()
    {
        return view('pkbm.create');
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
        ]);

        DB::transaction(function () use ($request) {
            $lembaga = Lembaga::create([
                'npsn'             => $request->npsn,
                'nama_lembaga'     => $request->nama_lembaga,
                'pengelola'        => $request->pengelola,
                'alamat'           => $request->alamat,
                'telepon'          => $request->telepon,
                'jenis_lembaga_id' => 1,
            ]);

            if ($request->no_sertifikat || $request->masa_berlaku || $request->keterangan) {
                IzinLembaga::create([
                    'lembaga_id'    => $lembaga->id,
                    'no_sertifikat' => $request->no_sertifikat,
                    'masa_berlaku'  => $request->masa_berlaku,
                ]);
            }
        });

        return redirect()->route('pkbm.index')->with('success', 'Data PKBM berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $data = Lembaga::with('izin')->findOrFail($id);
        return view('pkbm.show', compact('data'));
    }

    public function edit(string $id)
    {
        $data = Lembaga::with('izin')->findOrFail($id);
        return view('pkbm.edit', compact('data'));
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
                ]
            );
        });

        return redirect()->route('pkbm.index')
            ->with('success', 'Data PKBM berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $lembaga = Lembaga::findOrFail($id);


        $lembaga->delete();

        return redirect()->route('pkbm.index')
            ->with('success', 'Data PKBM berhasil dihapus');
    }
}
