<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\KasKeuangan;
use App\Models\Pekerja;
use App\Models\Cctv;
use App\Models\Notifikasi;

use App\Models\PembayaranOperasional;
use App\Models\PembayaranGaji;
use App\Exports\DashboardExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function readNotif($id)
{
    $notif = Notifikasi::findOrFail($id);
    $notif->update(['dibaca' => true]);

    return back();
}
    public function index(Request $request)
    {
        $bulan = $request->bulan;

        // ================= SUMMARY =================
        $total = Pembayaran::sum('nominal');
        $jumlah = Pembayaran::count();
        //notif

        $notifs = Notifikasi::latest()->take(10)->get();


        // ================= JOGJA =================
        $masuk_jogja = KasKeuangan::where('lokasi','Jogja')->where('jenis','masuk')->sum('nominal');
        $keluar_jogja =
            KasKeuangan::where('lokasi','Jogja')->where('jenis','keluar')->sum('nominal')
            + PembayaranOperasional::where('lokasi','Jogja')->sum('nominal')
            + PembayaranGaji::where('lokasi','Jogja')->sum('nominal');

        $jogja = $masuk_jogja - $keluar_jogja;

        // ================= BELITUNG =================
        $masuk_belitung = KasKeuangan::where('lokasi','Belitung')->where('jenis','masuk')->sum('nominal');
        $keluar_belitung =
            KasKeuangan::where('lokasi','Belitung')->where('jenis','keluar')->sum('nominal')
            + PembayaranOperasional::where('lokasi','Belitung')->sum('nominal')
            + PembayaranGaji::where('lokasi','Belitung')->sum('nominal');

        $belitung = $masuk_belitung - $keluar_belitung;

        // ================= GRESIK =================
        $masuk_gresik = KasKeuangan::where('lokasi','Gresik')->where('jenis','masuk')->sum('nominal');
        $keluar_gresik =
            KasKeuangan::where('lokasi','Gresik')->where('jenis','keluar')->sum('nominal')
            + PembayaranOperasional::where('lokasi','Gresik')->sum('nominal')
            + PembayaranGaji::where('lokasi','Gresik')->sum('nominal');

        $gresik = $masuk_gresik - $keluar_gresik;

        // ================= STATUS =================
        $status_jogja = $this->statusKeuangan($masuk_jogja, $keluar_jogja);
        $status_belitung = $this->statusKeuangan($masuk_belitung, $keluar_belitung);
        $status_gresik = $this->statusKeuangan($masuk_gresik, $keluar_gresik);

        // ================= PEKERJA =================
        $total_pekerja = Pekerja::count();

        $pekerja_jogja = Pekerja::where('lokasi', 'Jogja')->count();
        $pekerja_gresik = Pekerja::where('lokasi', 'Gresik')->count();
        $pekerja_belitung = Pekerja::where('lokasi', 'Belitung')->count();

        $rek_jogja = Pekerja::where('lokasi', 'Jogja')->latest()->first();
        $rek_belitung = Pekerja::where('lokasi', 'Belitung')->latest()->first();
        $rek_gresik = Pekerja::where('lokasi', 'Gresik')->latest()->first();

        // ================= GRAFIK =================
        $grafik = KasKeuangan::select(
            DB::raw('MONTH(tanggal) as bulan'),
            DB::raw("SUM(CASE WHEN jenis='masuk' THEN nominal ELSE 0 END) as masuk"),
            DB::raw("SUM(CASE WHEN jenis='keluar' THEN nominal ELSE 0 END) as keluar")
        );

        if ($bulan) {
            $grafik->whereMonth('tanggal', $bulan);
        }

        $grafik = $grafik->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // ================= CCTV =================
        $cctvs = Cctv::latest()->take(4)->get();

        return view('dashboard', compact(
            'cctvs',
            'total',
            'jumlah',
            'jogja',
            'gresik',
            'belitung',
            'grafik',
            'total_pekerja',
            'pekerja_jogja',
            'pekerja_gresik',
            'pekerja_belitung',
            'rek_jogja',
            'rek_belitung',
            'rek_gresik',
            'masuk_jogja','keluar_jogja','status_jogja',
            'masuk_belitung','keluar_belitung','status_belitung',
            'masuk_gresik','keluar_gresik','status_gresik',
            // 'notifikasis',
            'notifs'
        ));
    }

    // ================= EXPORT =================
    public function export(Request $request)
    {
        return Excel::download(
            new DashboardExport($request->tanggal),
            'dashboard.xlsx'
        );
    }

    // ================= FUNCTION STATUS =================
    private function statusKeuangan($masuk, $keluar)
    {
        $saldo = $masuk - $keluar;

        if ($saldo > 10000000) return ['Aman','green'];
        if ($saldo > 0) return ['Pantau','yellow'];
        return ['Kritis','red'];
    }
}