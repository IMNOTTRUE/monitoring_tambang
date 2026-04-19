<?php

namespace App\Http\Controllers;
use App\Models\KasKeuangan;
use App\Models\Pembayaran;
use App\Models\SerahTerima;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $data = Pembayaran::with('serahTerima')->latest()->get();
        return view('pembayaran.index', compact('data'));
    }

    public function create($id)
    {
        $serah = SerahTerima::findOrFail($id);
        
        return view('pembayaran.create', compact('serah'));
    }

   public function store(Request $request)
{
    $request->validate([
        'serah_terima_id' => 'required',
        'nominal' => 'required|numeric',
        'bukti_pembayaran' => 'nullable|image', // 🔥 tambah ini
    ]);
$serah = SerahTerima::findOrFail($request->serah_terima_id);

$serah->update([
    'lunas' => true
]);

if ($request->hasFile('bukti_pembayaran')) {
    $path = $request->file('bukti_pembayaran')->store('pembayaran', 'public');
} else {
    $path = null;
}

Pembayaran::create([
    'serah_terima_id' => $request->serah_terima_id,
    'user_id' => Auth::id(),
    'nominal' => $request->nominal,
    'status' => 'lunas',
    'tanggal_bayar' => now(),
    'bukti_pembayaran' => $path,
]);

KasKeuangan::create([
    'lokasi' => $serah->lokasi, // 🔥 AUTO DARI SERAH TERIMA
    'jenis' => 'keluar',
    'nominal' => $request->nominal,
    'keterangan' => 'Pembayaran serah terima #' . $request->serah_terima_id,
    'tanggal' => now(),
]);
}
    
}