<x-app-layout>

<style>
    /* RESET & BASE */
    * {
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    /* BASE STYLING */
    .page-wrapper {
        padding: 24px;
        background-color: #f8f9fa;
        min-height: 100vh;
    }

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

    /* BUTTON BACK */
    .btn-dashboard {
        background: #ffffff;
        color: #374151;
        padding: 10px 18px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        border: 1px solid #d1d5db;
        transition: 0.2s;
        display: inline-block;
    }

    .btn-dashboard:hover {
        background: #f3f4f6;
    }

    /* CARD CONTAINER */
    .box {
        background: white;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        border: 1px solid #e5e7eb;
    }

    /* RESPONSIVE TABLE WRAPPER */
    .table-responsive {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch; /* Smooth scroll on iOS */
    }

    /* TABLE STYLING */
    .data-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    .data-table th {
        background: #f9fafb;
        color: #6b7280;
        font-weight: 600;
        text-align: left;
        padding: 12px 15px;
        border-bottom: 1px solid #e5e7eb;
        text-transform: uppercase;
        font-size: 12px;
    }

    .data-table td {
        padding: 12px 15px;
        border-bottom: 1px solid #f3f4f6;
        vertical-align: middle;
        color: #374151;
    }

    /* BADGE STATUS */
    .badge-lunas {
        background: #dcfce7;
        color: #15803d;
        padding: 4px 12px;
        border-radius: 99px;
        font-weight: 800;
        font-size: 11px;
        border: 1px solid #bbf7d0;
        display: inline-block;
    }

    /* BUKTI PEMBAYARAN THUMBNAIL */
    .img-bukti {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 4px;
        cursor: pointer;
        border: 1px solid #e5e7eb;
        transition: 0.2s;
    }

    .img-bukti:hover { 
        transform: scale(1.2); 
        z-index: 10;
    }

    /* NOMINAL HIGHLIGHT */
    .nominal-text {
        font-weight: 700;
        color: #059669; /* Green Emerald */
        font-family: 'Courier New', Courier, monospace;
    }

    /* MODAL FOR IMAGE ZOOM */
    #imageModal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0; top: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.8);
        align-items: center;
        justify-content: center;
    }

    /* MEDIA QUERIES UNTUK RESPONSIVE (MOBILE) */
    @media (max-width: 768px) {
        .page-wrapper {
            padding: 16px; /* Kurangi padding di layar kecil */
        }

        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 16px; /* Beri jarak antara judul dan tombol */
        }

        .box {
            padding: 16px; /* Kurangi padding dalam box */
        }

        .data-table th, 
        .data-table td {
            white-space: nowrap; /* Mencegah teks turun ke bawah / squished */
            padding: 10px 12px;
        }
    }
</style>

<div class="page-wrapper">
    
    <div class="page-header">
        <div>
            <h2 class="page-title">Riwayat Pembayaran</h2>
            <p style="color: #6b7280; font-size: 14px; margin-top: 4px; margin-bottom: 0;">Daftar transaksi lunas yang telah terverifikasi sistem.</p>
        </div>
        <a href="{{ route('dashboard') }}" class="btn-dashboard">← Kembali ke Dashboard</a>
    </div>

    @if(session('success'))
        <div style="background: #d1fae5; color: #065f46; padding: 12px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #a7f3d0; font-size: 14px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="box">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Tanggal Bayar</th>
                        <th>Keterangan Serah Terima</th>
                        <th>Nominal</th>
                        <th>Status</th>
                        <th>Bukti Transfer</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td style="white-space: nowrap;">
                            {{ \Carbon\Carbon::parse($item->tanggal_bayar)->format('d M Y') }}
                        </td>
                        <td>
                            <span style="font-size: 13px; color: #6b7280;">ID: ST-{{ $item->serah_terima_id }}</span><br>
                            <strong>{{ $item->serahTerima->keterangan ?? 'Tanpa Keterangan' }}</strong>
                        </td>
                        <td>
                            <span class="nominal-text">Rp {{ number_format($item->nominal, 0, ',', '.') }}</span>
                        </td>
                        <td>
                            <span class="badge-lunas">✓ LUNAS</span>
                        </td>
                        <td>
                            @if($item->bukti_pembayaran)
                                <img src="{{ asset('storage/'.$item->bukti_pembayaran) }}" 
                                     class="img-bukti" 
                                     onclick="openZoom(this.src)" 
                                     title="Klik untuk memperbesar">
                            @else
                                <span style="color: #9ca3af; font-size: 11px; font-style: italic;">Tidak ada bukti</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px; color: #9ca3af;">
                            Belum ada data pembayaran terekam.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="imageModal" onclick="closeZoom()">
    <img id="imgZoomed" style="max-width: 90%; max-height: 90%; border-radius: 8px; box-shadow: 0 0 50px rgba(0,0,0,0.8);">
</div>

<script>
    function openZoom(src) {
        document.getElementById('imgZoomed').src = src;
        document.getElementById('imageModal').style.display = "flex";
    }

    function closeZoom() {
        document.getElementById('imageModal').style.display = "none";
    }
</script>

</x-app-layout>