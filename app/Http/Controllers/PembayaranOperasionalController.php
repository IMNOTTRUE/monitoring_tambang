<?php

namespace App\Http\Controllers;
use App\Models\PembayaranOperasional;
use Illuminate\Http\Request;

class PembayaranOperasionalController extends Controller
{


public function index()
{
    $data = PembayaranOperasional::latest()->get();
    return view('operasional.index', compact('data'));
}

public function create()
{
    return view('operasional.create');
}

public function store(Request $request)
{
    PembayaranOperasional::create([
        'lokasi' => $request->lokasi,
        'nominal' => $request->nominal,
        'keterangan' => $request->keterangan,
        'tanggal' => now(),
    ]);

    return redirect()->route('operasional.index')
        ->with('success','Data operasional berhasil ditambahkan');
}
public function destroy($id)
{
    $data = PembayaranOperasional::findOrFail($id);
    $data->delete();

    return redirect()->route('operasional.index')
        ->with('success','Data berhasil dihapus');
}

public function edit($id)
{
    $data = PembayaranOperasional::findOrFail($id);
    return view('operasional.edit', compact('data'));
}

public function update(Request $request, $id)
{
    $data = PembayaranOperasional::findOrFail($id);

    $data->update([
        'lokasi' => $request->lokasi,
        'nominal' => $request->nominal,
        'keterangan' => $request->keterangan,
        'tanggal' => $request->tanggal,
    ]);

    return redirect()->route('operasional.index')
        ->with('success','Data berhasil diupdate');
}
}
