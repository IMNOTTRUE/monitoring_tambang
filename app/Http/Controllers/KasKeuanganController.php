<?php

namespace App\Http\Controllers;
use App\Exports\KasExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\KasKeuangan;
use Illuminate\Http\Request;

class KasKeuanganController extends Controller
{
    public function index(Request $request)
    {
        $query = KasKeuangan::query();

        if ($request->lokasi) {
            $query->where('lokasi', $request->lokasi);
        }

        $data = $query->latest()->get();

        return view('kas.index', compact('data'));
    }

    public function create()
    {
        return view('kas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'lokasi' => 'required',
            'jenis' => 'required',
            'nominal' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        KasKeuangan::create($request->all());

        return redirect()->route('kas.index')
            ->with('success', 'Data berhasil ditambahkan');
    }
    public function edit($id)
{
    $data = KasKeuangan::findOrFail($id);
    return view('kas.edit', compact('data'));
}
    public function update(Request $request, $id)
{
    $data = KasKeuangan::findOrFail($id);

    $data->update([
        'tanggal' => $request->tanggal,
        'lokasi' => $request->lokasi,
        'keterangan' => $request->keterangan,
        'jenis' => $request->jenis,
        'nominal' => $request->nominal,
    ]);

    return redirect()->route('kas.index')->with('success','Data berhasil diupdate');
}

public function destroy($id)
{
    KasKeuangan::findOrFail($id)->delete();

    return back()->with('success','Data berhasil dihapus');
}

public function export(Request $request)
{
    $data = KasKeuangan::when($request->lokasi, function($q) use ($request) {
        $q->where('lokasi', $request->lokasi);
    })->get();

    return Excel::download(new KasExport($data), 'kas.xlsx');
}
}
