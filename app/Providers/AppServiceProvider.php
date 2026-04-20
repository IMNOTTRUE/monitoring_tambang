<?php

namespace App\Providers;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\KasKeuangan;
use App\Models\Pekerja;
use App\Models\Cctv;

use App\Models\PembayaranOperasional;
use App\Models\PembayaranGaji;
use App\Exports\DashboardExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
    view()->composer('*', function ($view) {

        $notifs = Notifikasi::latest()->take(10)->get();
        $unread = Notifikasi::where('dibaca', false)->count();
         URL::forceScheme('https');
        $view->with('notifs', $notifs);
        $view->with('unread', $unread);

    });
    }
    
}
