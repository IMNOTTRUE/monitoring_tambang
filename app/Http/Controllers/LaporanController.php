<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;

class LaporanController extends Controller
{
    public function index()
    {
        $data = Pembayaran::with('serahTerima')->get();

        $total = $data->sum('nominal');

        return view('laporan.index', compact('data', 'total'));
    }
}