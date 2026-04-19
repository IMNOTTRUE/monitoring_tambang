<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\Pengiriman;
use App\Models\Notifikasi;
use App\Events\NotifEvent;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PengirimanController extends Controller
{
    // 📋 Tampilkan semua data
    public function index()
    {
        $pengiriman = Pengiriman::latest()->get();
        return view('pengiriman.index', compact('pengiriman'));
    }

    // ➕ Form tambah
    public function create()
    {
        return view('pengiriman.create');
    }

    // 💾 Simpan data
public function store(Request $request)
{
    $request->validate([
        'tanggal' => 'required|date',
        'keterangan' => 'required',
        'dokumentasi' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'berita_acara' => 'required',
        'nominal_pembayaran' => 'required|numeric',
    ],[
    'tanggal.required' => 'Tanggal wajib diisi!',
    'keterangan.required' => 'Keterangan wajib diisi!',
    'dokumentasi.required' => 'Foto wajib diupload!',
    'berita_acara.required' => 'Berita acara wajib diisi!',
    'nominal_pembayaran.required' => 'Nominal wajib diisi!',
]
    );

    // upload file
    $path = $request->file('dokumentasi')->store('dokumentasi', 'public');

    Pengiriman::create([
        'user_id' => auth()->id(),
        'tanggal' => $request->tanggal,
        'keterangan' => $request->keterangan,
        'dokumentasi' => $path, // 🔥 simpan path
        'berita_acara' => $request->berita_acara,
        'nominal_pembayaran' => $request->nominal_pembayaran,
    ]);
Notifikasi::create([
    'pesan' => auth()->user()->name . ' menambahkan pengiriman'
]);

event(new NotifEvent(
    auth()->user()->name . ' menambahkan pengiriman'
));

return redirect()->route('pengiriman.index')
    ->with('success', 'Data berhasil ditambahkan');
}

    // 👁️ Detail
    public function show(string $id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        return view('pengiriman.show', compact('pengiriman'));
    }

    // ✏️ Form edit
    public function edit(string $id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        return view('pengiriman.edit', compact('pengiriman'));
    }

public function update(Request $request, $id)
{
    $pengiriman = Pengiriman::findOrFail($id);

    $request->validate([
        'tanggal' => 'required|date',
        'keterangan' => 'required',
        'dokumentasi' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'berita_acara' => 'required',
        'nominal_pembayaran' => 'required|numeric',
    ],[
    'tanggal.required' => 'Tanggal wajib diisi!',
    'keterangan.required' => 'Keterangan wajib diisi!',
    'dokumentasi.required' => 'Foto wajib diupload!',
    'berita_acara.required' => 'Berita acara wajib diisi!',
    'nominal_pembayaran.required' => 'Nominal wajib diisi!',
]);

    $data = [
        'tanggal' => $request->tanggal,
        'keterangan' => $request->keterangan,
        'berita_acara' => $request->berita_acara,
        'nominal_pembayaran' => $request->nominal_pembayaran,
    ];

    // 🔥 CEK apakah upload file baru
    if ($request->hasFile('dokumentasi')) {

        // 🔥 HAPUS gambar lama
        if ($pengiriman->dokumentasi) {
            Storage::disk('public')->delete($pengiriman->dokumentasi);
        }

        // 🔥 SIMPAN gambar baru
        $data['dokumentasi'] = $request->file('dokumentasi')->store('dokumentasi', 'public');
    }

    $pengiriman->update($data);
Notifikasi::create([
    'pesan' => auth()->user()->name . ' mengedit data Pengiriman'
    
]);
event(new NotifEvent(
    auth()->user()->name . ' mengedit data pengiriman'
));
    return redirect()->route('pengiriman.index')
        ->with('success', 'Data berhasil diupdate');
}
    // 🗑️ Hapus data
    public function destroy(string $id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        $pengiriman->delete();

        return redirect()->route('pengiriman.index')
            ->with('success', 'Data berhasil dihapus');
    }
    public function user()
{

    return $this->belongsTo(User::class);
}

}
