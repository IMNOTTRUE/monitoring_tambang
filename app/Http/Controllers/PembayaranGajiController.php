<?php

namespace App\Http\Controllers;
use App\Models\PembayaranGaji;
use Illuminate\Http\Request;
use App\Models\Pekerja;

class PembayaranGajiController extends Controller
{

public function index()
{   $bulan = now()->month;
    $tahun = now()->year;
    $pekerja = Pekerja::all();
    $data = PembayaranGaji::latest()->get();
    return view('gaji.index', compact('data','pekerja','bulan','tahun'));
}

public function create()
{
    return view('gaji.create');
}

public function store(Request $request)
{
    $pekerja = Pekerja::findOrFail($request->pekerja_id);
    PembayaranGaji::create([
        'pekerja_id' => $request->pekerja_id,
        'lokasi' => $request->lokasi,
        'nominal' => $request->nominal ?? $pekerja->gaji ?? 0,
        'bulan' => $request->bulan ?? now()->month,
        'tahun' => now()->year,
        'status' => true,
        'tanggal' => now(),
    ]);

    return back()->with('success','Gaji dibayar');
}
public function rekap()
{
    $data = PembayaranGaji::with('pekerja')
        ->latest()
        ->get();

    return view('gaji.rekap', compact('data'));
    
}

}
