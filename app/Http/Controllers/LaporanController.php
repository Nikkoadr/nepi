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
        $request->merge(['status' => 'expired']);
        return $this->generateLaporan($request, 'Lembaga Izin Kadaluarsa', 'laporan.expired');
    }

    /**
     * Logic inti untuk mengambil data dengan filter tanggal (Real-time)
     */
    private function getLaporanData(Request $request)
    {
        $query = Lembaga::with(['izin', 'jenis']);
        $today = Carbon::today();

        // 1. Filter Jenis Lembaga
        if ($request->filled('jenis_lembaga_id')) {
            $query->where('jenis_lembaga_id', $request->jenis_lembaga_id);
        }

        // 2. Filter Status Izin Berdasarkan Tanggal (Tanpa kolom status)
        if ($request->filled('status')) {
            $query->whereHas('izin', function ($q) use ($today, $request) {
                if ($request->status === 'expired') {
                    $q->whereDate('masa_berlaku', '<=', $today);
                } elseif ($request->status === 'aktif') {
                    $q->whereDate('masa_berlaku', '>', $today);
                } elseif ($request->status === 'warning') {
                    $q->whereDate('masa_berlaku', '>', $today)
                        ->whereDate('masa_berlaku', '<=', $today->copy()->addDays(30));
                }
            });
        }

        // 3. Filter Rentang Tanggal Manual
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereHas('izin', function ($q) use ($request) {
                $q->whereBetween('masa_berlaku', [$request->start_date, $request->end_date]);
            });
        }

        $data = $query->latest()->get();

        // 4. Mapping Status secara dinamis (PENTING: Agar index & cetak punya data yang sama)
        return $data->map(function ($item) use ($today) {
            if ($item->izin && $item->izin->masa_berlaku) {
                $masaBerlaku = Carbon::parse($item->izin->masa_berlaku);

                if ($masaBerlaku->isPast()) {
                    $item->status_teks = "Kadaluarsa";
                    $item->status_label = "danger";
                } else {
                    $sisaHari = $today->diffInDays($masaBerlaku, false);
                    if ($sisaHari <= 30) {
                        $item->status_teks = "Hampir Habis ($sisaHari Hari)";
                        $item->status_label = "warning";
                    } else {
                        $item->status_teks = "Aktif";
                        $item->status_label = "success";
                    }
                }
            } else {
                $item->status_teks = "N/A";
                $item->status_label = "secondary";
            }
            return $item;
        });
    }

    private function generateLaporan(Request $request, $title, $route_name)
    {
        $data = $this->getLaporanData($request);
        $jenisLembaga = JenisLembaga::all();

        return view('laporan.index', compact('data', 'jenisLembaga', 'title', 'route_name'));
    }

    public function cetak(Request $request)
    {
        // Sekarang cetak memanggil fungsi yang sama dengan index
        $data = $this->getLaporanData($request);
        $title = "Laporan Rekapitulasi Data Lembaga";

        return view('laporan.cetak', compact('data', 'title'));
    }
}
