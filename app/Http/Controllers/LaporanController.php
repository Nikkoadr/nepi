<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lembaga;
use App\Models\JenisLembaga;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return $this->generateLaporan($request, 'Laporan Data Lembaga', 'laporan.index');
    }

    public function izin(Request $request)
    {
        return $this->generateLaporan($request, 'Laporan Izin Lembaga', 'laporan.izin');
    }

    public function expired(Request $request)
    {
        // Override status to expired
        $request->merge(['status' => 'expired']); 
        return $this->generateLaporan($request, 'Lembaga Izin Kadaluarsa', 'laporan.expired');
    }

    private function generateLaporan(Request $request, $title, $route_name)
    {
        $query = Lembaga::with(['izin', 'jenis']);

        // Filter Jenis Lembaga
        if ($request->filled('jenis_lembaga_id')) {
            $query->where('jenis_lembaga_id', $request->jenis_lembaga_id);
        }

        // Filter Status Izin
        if ($request->filled('status')) {
            if ($request->status === 'expired') {
                $query->whereHas('izin', function($q) {
                    $q->whereIn('status', ['habis', 'kadaluarsa']);
                });
            } else if($request->status === 'aktif') {
                $query->whereHas('izin', function($q) use ($request) {
                    $q->where('status', 'aktif');
                });
            } else {
                $query->whereHas('izin', function($q) use ($request) {
                    $q->where('status', $request->status);
                });
            }
        }

        // Filter Rentang Tanggal Masa Berlaku
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereHas('izin', function($q) use ($request) {
                $q->whereBetween('masa_berlaku', [$request->start_date, $request->end_date]);
            });
        }

        $data = $query->latest()->get();
        $jenisLembaga = JenisLembaga::all();

        return view('laporan.index', compact('data', 'jenisLembaga', 'title', 'route_name'));
    }

    public function cetak(Request $request)
    {
        $query = Lembaga::with(['izin', 'jenis']);

        if ($request->filled('jenis_lembaga_id')) {
            $query->where('jenis_lembaga_id', $request->jenis_lembaga_id);
        }

        if ($request->filled('status')) {
            if ($request->status === 'expired') {
                $query->whereHas('izin', function($q) {
                    $q->whereIn('status', ['habis', 'kadaluarsa']);
                });
            } else {
                $query->whereHas('izin', function($q) use ($request) {
                    $q->where('status', $request->status);
                });
            }
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereHas('izin', function($q) use ($request) {
                $q->whereBetween('masa_berlaku', [$request->start_date, $request->end_date]);
            });
        }

        $data = $query->latest()->get();
        $title = "Laporan Rekapitulasi Data Lembaga";

        return view('laporan.cetak', compact('data', 'title'));
    }
}
