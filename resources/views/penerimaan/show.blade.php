<x-app-layout>
@section('content')
<div class="container">
    <h2>Detail penerimaan</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Nama Barang:</strong> {{ $penerimaan->nama_barang }}</p>
            <p><strong>Jumlah:</strong> {{ $penerimaan->jumlah }}</p>
            <p><strong>Tujuan:</strong> {{ $penerimaan->tujuan }}</p>
            <p><strong>Tanggal Kirim:</strong> {{ $penerimaan->tanggal_kirim }}</p>
        </div>
    </div>

    <a href="{{ route('penerimaan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
</x-app-layout>