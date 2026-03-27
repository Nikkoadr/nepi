<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lembaga;
use App\Models\IzinLembaga;
use App\Models\JenisLembaga;
use App\Models\KategoriPaud;

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
    $totalLembaga = Lembaga::count();
    $izinAktif = IzinLembaga::where('status', 'aktif')->count();
    $izinExpired = IzinLembaga::whereIn('status', ['habis', 'kadaluarsa'])->count();
    
    $jenisLembagaData = JenisLembaga::withCount('lembaga')->get();
    
    $statusIzinData = [
        'aktif' => IzinLembaga::where('status', 'aktif')->count(),
        'habis' => IzinLembaga::where('status', 'habis')->count(),
        'kadaluarsa' => IzinLembaga::where('status', 'kadaluarsa')->count(),
    ];

    $kategoriPaudData = KategoriPaud::withCount('lembaga')->get();

    return view('home', compact(
        'totalLembaga', 'izinAktif', 'izinExpired', 
        'jenisLembagaData', 'statusIzinData', 'kategoriPaudData'
    ));
}
}
