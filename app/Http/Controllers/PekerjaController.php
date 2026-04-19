<?php

namespace App\Http\Controllers;

use App\Models\Pekerja;
use Illuminate\Http\Request;

class PekerjaController extends Controller
{
   public function index(Request $request)
{
    $lokasi = $request->lokasi;

    $query = Pekerja::query();

    if ($lokasi) {
        $query->where('lokasi', $lokasi);
    }

    $data = $query->latest()->get();

    return view('pekerja.index', compact('data', 'lokasi'));
}

    public function create()
    {
        return view('pekerja.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'lokasi' => 'required',
        ]);

        Pekerja::create($request->all());

        return redirect()->route('pekerja.index')
            ->with('success', 'Data pekerja berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pekerja = Pekerja::findOrFail($id);
        return view('pekerja.edit', compact('pekerja'));
    }

    public function update(Request $request, $id)
    {
        $pekerja = Pekerja::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'lokasi' => 'required',
        ]);

        $pekerja->update($request->all());

        return redirect()->route('pekerja.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $pekerja = Pekerja::findOrFail($id);
        $pekerja->delete();

        return redirect()->route('pekerja.index')
            ->with('success', 'Data berhasil dihapus');
    }
    
}