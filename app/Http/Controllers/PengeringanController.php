<?php

namespace App\Http\Controllers;
use App\Events\NotifEvent;
use App\Models\Pengeringan;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengeringanController extends Controller
{
    public function index()
    {
        $pengeringan = Pengeringan::latest()->get();
        return view('pengeringan.index', compact('pengeringan'));
    }

    public function create()
    {
        return view('pengeringan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required',
            'dokumentasi' => 'required|image',
            'berita_acara' => 'required',
            'quantity' => 'required',
            'nominal_pembayaran' => 'required|numeric',
        ], [
            'tanggal.required' => 'Tanggal wajib diisi!',
            'dokumentasi.required' => 'Foto wajib diupload!',
        ]);

        $path = $request->file('dokumentasi')->store('pengeringan', 'public');

        pengeringan::create([
            'user_id' => Auth::id(),
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'dokumentasi' => $path,
            'quantity' => $request->quantity,
            'berita_acara' => $request->berita_acara,
            'nominal_pembayaran' => $request->nominal_pembayaran,
        ]);
Notifikasi::create([
    'pesan' => auth()->user()->name . ' menambahkan pengeringan'
]);

event(new NotifEvent(
    auth()->user()->name . ' menambahkan pengeringan'
));
        return redirect()->route('pengeringan.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pengeringan = Pengeringan::findOrFail($id);
        return view('pengeringan.edit', compact('pengeringan'));
    }

    public function update(Request $request, $id)
    {
        $pengeringan = Pengeringan::findOrFail($id);

        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required',
              'quantity' => 'required',
            'berita_acara' => 'required',
            'nominal_pembayaran' => 'required|numeric',
        ]);

        if ($request->hasFile('dokumentasi')) {
            Storage::disk('public')->delete($pengeringan->dokumentasi);
            $path = $request->file('dokumentasi')->store('pengeringan', 'public');
        } else {
            $path = $pengeringan->dokumentasi;
        }

        $pengeringan->update([
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'dokumentasi' => $path,
            'quantity' => $request->quantity,
            'berita_acara' => $request->berita_acara,
            'nominal_pembayaran' => $request->nominal_pembayaran,
        ]);
        Notifikasi::create([
            'pesan' => auth()->user()->name . ' mengedit data pengeringan'
        ]);
        event(new NotifEvent(
    auth()->user()->name . ' mengedit data pengeringan'
));
        return redirect()->route('pengeringan.index')->with('success', 'Data berhasil diupdate');
        
    }

    public function destroy($id)
    {
        $pengeringan = Pengeringan::findOrFail($id);
        Storage::disk('public')->delete($pengeringan->dokumentasi);
        $pengeringan->delete();

        return redirect()->route('pengeringan.index')->with('success', 'Data dihapus');
    }
}