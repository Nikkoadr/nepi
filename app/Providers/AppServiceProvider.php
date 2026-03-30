<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\IzinLembaga;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {

            $today = Carbon::today();

            $notifikasi = IzinLembaga::with('lembaga')
                ->where(function ($q) use ($today) {
                    $q->whereBetween('masa_berlaku', [$today, $today->copy()->addDays(30)])
                    ->orWhere('masa_berlaku', '<', $today);
                })
                ->orderBy('masa_berlaku', 'asc') // paling urgent dulu
                ->take(5)
                ->get();

            $view->with([
                'notifikasi' => $notifikasi,
                'totalNotif' => $notifikasi->count()
            ]);
        });
    }
}
