<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IzinLembaga;
use Carbon\Carbon;

class NotifikasiController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $expired = IzinLembaga::with('lembaga.jenis')
            ->where('masa_berlaku', '<', $today)
            ->get();

        $hampir = IzinLembaga::with('lembaga.jenis')
            ->whereBetween('masa_berlaku', [$today, $today->copy()->addDays(30)])
            ->get();

        $data = $expired->merge($hampir)->sortBy('masa_berlaku');

        return view('notifikasi.index', compact('data'));
    }

    public function show($id)
    {
        $data = IzinLembaga::with('lembaga.jenis')
            ->findOrFail($id);

        return view('notifikasi.show', compact('data'));
    }
}