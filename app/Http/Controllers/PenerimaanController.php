<?php

namespace App\Http\Controllers;

use App\Events\NotifEvent;
use App\Models\Penerimaan;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PenerimaanController extends Controller
{
    public function index()
    {
        $penerimaan = Penerimaan::latest()->get();
        return view('penerimaan.index', compact('penerimaan'));
    }

    public function create()
    {
        return view('penerimaan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required',
            'dokumentasi' => 'required|image',
            'berita_acara' => 'required',
            'nominal_pembayaran' => 'required|numeric',
        ], [
            'tanggal.required' => 'Tanggal wajib diisi!',
            'dokumentasi.required' => 'Foto wajib diupload!',
        ]);

        $path = $request->file('dokumentasi')->store('penerimaan', 'public');

        Penerimaan::create([
            'user_id' => Auth::id(),
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'dokumentasi' => $path,
            'berita_acara' => $request->berita_acara,
            'nominal_pembayaran' => $request->nominal_pembayaran,
        ]);
        Notifikasi::create([
            'pesan' => auth()->user()->name . ' menambahkan penerimaan'
        ]);

        event(new NotifEvent(
            auth()->user()->name . ' menambahkan penerimaan'
        ));
        return redirect()->route('penerimaan.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $penerimaan = Penerimaan::findOrFail($id);
        return view('penerimaan.edit', compact('penerimaan'));
    }

    public function update(Request $request, $id)
    {
        $penerimaan = Penerimaan::findOrFail($id);

        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required',
            'berita_acara' => 'required',
            'nominal_pembayaran' => 'required|numeric',
        ]);

        if ($request->hasFile('dokumentasi')) {
            Storage::disk('public')->delete($penerimaan->dokumentasi);
            $path = $request->file('dokumentasi')->store('penerimaan', 'public');
        } else {
            $path = $penerimaan->dokumentasi;
        }

        $penerimaan->update([
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'dokumentasi' => $path,
            'berita_acara' => $request->berita_acara,
            'nominal_pembayaran' => $request->nominal_pembayaran,
        ]);
    Notifikasi::create([
        'pesan' => auth()->user()->name . ' mengedit data penerimaan'
        
    ]);
    event(new NotifEvent(
    auth()->user()->name . ' mengedit data penerimaan'
));
        return redirect()->route('penerimaan.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $penerimaan = Penerimaan::findOrFail($id);
        Storage::disk('public')->delete($penerimaan->dokumentasi);
        $penerimaan->delete();

        return redirect()->route('penerimaan.index')->with('success', 'Data dihapus');
    }
    
}