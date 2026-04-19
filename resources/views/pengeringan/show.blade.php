<x-app-layout>
@section('content')
<div class="container">
    <h2>Detail pengeringan</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Nama Barang:</strong> {{ $pengeringan->nama_barang }}</p>
            <p><strong>Jumlah:</strong> {{ $pengeringan->jumlah }}</p>
            <p><strong>Tujuan:</strong> {{ $pengeringan->tujuan }}</p>
            <p><strong>Tanggal Kirim:</strong> {{ $pengeringan->tanggal_kirim }}</p>
        </div>
    </div>

    <a href="{{ route('pengeringan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
</x-app-layout>