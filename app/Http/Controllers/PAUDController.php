<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lembaga;
use App\Models\IzinLembaga;
use App\Models\KategoriPaud;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PAUDController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $today = Carbon::today();

        $data = Lembaga::with('izin')
            ->where('jenis_lembaga_id', 3)
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
