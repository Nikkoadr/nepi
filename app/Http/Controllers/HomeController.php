<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lembaga;
use App\Models\IzinLembaga;
use App\Models\JenisLembaga;
use App\Models\KategoriPaud;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $today = Carbon::today();
        $oneMonthFromNow = Carbon::today()->addDays(30);

        // 1. Total Semua Lembaga
        $totalLembaga = Lembaga::count();

        // 2. Izin Aktif (Masa berlaku masih di atas hari ini)
        $izinAktif = IzinLembaga::whereDate('masa_berlaku', '>', $today)->count();

        // 3. Izin Expired (Masa berlaku sudah lewat atau hari ini)
        $izinExpired = IzinLembaga::whereDate('masa_berlaku', '<=', $today)->count();

        // 4. Izin Hampir Habis (Kurang dari 30 hari tapi belum expired)
        $izinHampirHabis = IzinLembaga::whereDate('masa_berlaku', '>', $today)
            ->whereDate('masa_berlaku', '<=', $oneMonthFromNow)
            ->count();

        // 5. Data untuk Chart/Statistik
        $statusIzinData = [
            'aktif'         => IzinLembaga::whereDate('masa_berlaku', '>', $oneMonthFromNow)->count(),
            'hampir_habis'  => $izinHampirHabis,
            'kadaluarsa'    => $izinExpired,
        ];

        $jenisLembagaData = JenisLembaga::withCount('lembaga')->get();
        $kategoriPaudData = KategoriPaud::withCount('lembaga')->get();

        return view('home', compact(
            'totalLembaga',
            'izinAktif',
            'izinExpired',
            'izinHampirHabis',
            'jenisLembagaData',
            'statusIzinData',
            'kategoriPaudData'
        ));
    }
}
