<x-app-layout>
@section('content')
<div class="container">
    <h2>Detail Pengiriman</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Nama Barang:</strong> {{ $pengiriman->nama_barang }}</p>
            <p><strong>Jumlah:</strong> {{ $pengiriman->jumlah }}</p>
            <p><strong>Tujuan:</strong> {{ $pengiriman->tujuan }}</p>
            <p><strong>Tanggal Kirim:</strong> {{ $pengiriman->tanggal_kirim }}</p>
        </div>
    </div>

    <a href="{{ route('pengiriman.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
</x-app-layout>