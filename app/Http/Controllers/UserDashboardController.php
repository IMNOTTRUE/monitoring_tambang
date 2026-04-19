<?php

namespace App\Http\Controllers;
use App\Models\Pengiriman;
use App\Models\Penerimaan;
use App\Models\Pengeringan;
use App\Models\SerahTerima;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
public function index()
{
    $pengiriman = Pengiriman::latest()->take(5)->get();
    $penerimaan = Penerimaan::latest()->take(5)->get();
    $pengeringan = Pengeringan::latest()->take(5)->get();
    $serah = SerahTerima::latest()->take(5)->get();

    return view('user-dashboard', compact(
        'pengiriman',
        'penerimaan',
        'pengeringan',
        'serah'
    ));
}
}
