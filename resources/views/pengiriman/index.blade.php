<x-app-layout>

<style>
    
    /* RESET & BASE */
    * {
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .page-wrapper {
        padding: 24px;
        background-color: #f8f9fa; /* Senada dengan dashboard */
        min-height: 100vh;
    }

    /* HEADER PAGE */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .page-title {
        font-size: 24px;
        font-weight: bold;
        color: #111827;
        margin: 0;
    }

    /* BUTTON TAMBAH */
    .btn-add {
        background: #0f766e; /* Warna Teal seperti di dashboard */
        color: #ffffff;
        padding: 10px 16px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        transition: background-color 0.2s;
        border: none;
    }

    .btn-add:hover {
        background: #0d5f59;
        color: #ffffff;
    }

    /* ALERT SUCCESS */
    .alert-custom {
        background-color: #d1fae5;
        color: #065f46;
        padding: 12px 16px;
        border-radius: 6px;
        margin-bottom: 20px;
        border: 1px solid #a7f3d0;
        font-size: 14px;
        font-weight: 500;
    }

    /* CARD / BOX CONTAINER */
    .box {
        background: #ffffff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        border: 1px solid #e5e7eb;
        overflow-x: auto; /* Agar tabel bisa di-scroll ke samping jika layar kecil */
    }

    /* TABLE STYLING */
    .data-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    .data-table th, .data-table td {
        padding: 12px 16px;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
        vertical-align: middle;
    }

    .data-table th {
        color: #6b7280;
        font-weight: 600;
        background: #f9fafb;
        white-space: nowrap;
    }

    .data-table tbody tr:hover {
        background-color: #f9fafb; /* Efek hover pada baris */
    }

    /* IMAGE STYLING */
    .img-thumbnail {
        width: 60px;
        height: 60px;
        object-fit: cover; /* Agar gambar tidak gepeng */
        border-radius: 6px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }

    /* ACTION BUTTONS */
    .action-group {
        display: flex;
        gap: 8px; /* Jarak antar tombol aksi */
    }

    .btn-action {
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        color: white;
        border: none;
        cursor: pointer;
        display: inline-block;
    }

    .btn-detail { background: #3b82f6; } /* Biru */
    .btn-edit { background: #f59e0b; }   /* Kuning/Orange */
    .btn-delete { background: #ef4444; } /* Merah */

    .btn-action:hover {
        opacity: 0.9;
        color: white;
    }
</style>

<div class="page-wrapper">
    
    <div class="page-header">
        <h2 class="page-title">Data Pengiriman</h2>
        <a href="{{ route('pengiriman.create') }}" class="btn-add">
            + Tambah Data
        </a>
    </div>

    @if(session('success'))
        <div class="alert-custom">{{ session('success') }}</div>
    @endif

    <div class="box">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Dokumentasi</th>
                    <th>Berita Acara</th>
                    <th>Nominal</th>
                    <th>User</th> 
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengiriman as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td style="white-space: nowrap;">{{ $item->tanggal }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td>
                        @if($item->dokumentasi)
                            <img src="{{ asset('storage/' . $item->dokumentasi) }}" 
                                class="img-thumbnail" 
                                style="cursor: pointer;" 
                                onclick="showFullImage(this.src)" 
                                alt="Dokumentasi">
                        @else
                            <span style="color: #9ca3af; font-size: 12px; font-style: italic;">Tidak ada foto</span>
                        @endif
                    </td>
                    <td>{{ $item->berita_acara }}</td>
                    
                    <td style="white-space: nowrap; font-weight: 500; color: #111827;">
                        Rp {{ number_format($item->nominal_pembayaran, 0, ',', '.') }}
                    </td>

                    <td>{{ $item->user->name ?? '-' }}</td>

                    <td>
                        <div class="action-group">
                            <a href="{{ route('pengiriman.edit', $item->id) }}" class="btn-action btn-edit">Edit</a>

                            <form action="{{ route('pengiriman.destroy', $item->id) }}" method="POST" style="margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn-action btn-delete">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align: center; color: #6b7280; padding: 20px;">
                        Belum ada data pengiriman.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
<div id="imageModal" onclick="closeModal()" style="display:none; position:fixed; z-index:9999; left:0; top:0; width:100%; height:100%; background: rgba(0,0,0,0.8); align-items:center; justify-content:center;">
    <span style="position:absolute; top:20px; right:35px; color:white; font-size:40px; font-weight:bold; cursor:pointer;">&times;</span>
    <img id="modalImg" style="max-width:90%; max-height:90%; border-radius:10px; box-shadow: 0 0 20px rgba(0,0,0,0.5);">
</div>

<script>
    function showFullImage(src) {
        document.getElementById('modalImg').src = src;
        document.getElementById('imageModal').style.display = "flex";
    }

    function closeModal() {
        document.getElementById('imageModal').style.display = "none";
    }
</script>
</x-app-layout>