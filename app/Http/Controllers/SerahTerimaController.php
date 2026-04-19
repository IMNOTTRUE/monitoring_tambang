<?php

namespace App\Http\Controllers;

use App\Models\SerahTerima;
use App\Models\Notifikasi;
use App\Events\NotifEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SerahTerimaController extends Controller
{
    public function index()
    {
        $data = SerahTerima::latest()->get();
        return view('serah-terima.index', compact('data'));
    }

    public function create()
    {
        return view('serah-terima.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required',
            'dokumentasi' => 'required|image',
            'berita_acara' => 'required',
            'nominal_pembayaran' => 'required|numeric',
        ]);

        $path = $request->file('dokumentasi')->store('serah-terima', 'public');

        SerahTerima::create([
            'user_id' => Auth::id(),
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'dokumentasi' => $path,
            'berita_acara' => $request->berita_acara,
            'clear' => $request->has('clear'),
            'ada_kurang' => $request->has('ada_kurang'),
            'nominal_pembayaran' => $request->nominal_pembayaran,
        ]);
Notifikasi::create([
    'pesan' => auth()->user()->name . ' menambahkan serah terima'
]);

event(new NotifEvent(
    auth()->user()->name . ' menambahkan terima'
));
        return redirect()->route('serah-terima.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = SerahTerima::findOrFail($id);
        return view('serah-terima.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = SerahTerima::findOrFail($id);

        if ($request->hasFile('dokumentasi')) {
            Storage::disk('public')->delete($data->dokumentasi);
            $path = $request->file('dokumentasi')->store('serah-terima', 'public');
        } else {
            $path = $data->dokumentasi;
        }

        $data->update([
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'dokumentasi' => $path,
            'berita_acara' => $request->berita_acara,
            'clear' => $request->has('clear'),
            'ada_kurang' => $request->has('ada_kurang'),
            'nominal_pembayaran' => $request->nominal_pembayaran,
        ]);
Notifikasi::create([
    'pesan' => auth()->user()->name . ' mengedit data serah terima'
]);
event(new NotifEvent(
    auth()->user()->name . ' mengedit serah terima'
));
        return redirect()->route('serah-terima.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = SerahTerima::findOrFail($id);
        Storage::disk('public')->delete($data->dokumentasi);
        $data->delete();

        return back()->with('success', 'Data dihapus');
    }
}