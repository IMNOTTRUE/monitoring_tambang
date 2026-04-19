<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CctvController extends Controller
{
   public function index()
{
    $data = \App\Models\Cctv::latest()->get();
    return view('cctv.index', compact('data'));
}

public function create()
{
    return view('cctv.create');
}

public function store(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'lokasi' => 'required',
        'url' => 'required'
    ]);

    \App\Models\Cctv::create($request->all());

    return redirect()->route('cctv.index')->with('success','CCTV ditambahkan');
}
public function destroy($id)
{
    $data = \App\Models\Cctv::findOrFail($id);
    $data->delete();

    return redirect()->route('cctv.index')->with('success', 'CCTV berhasil dihapus');
}
}
