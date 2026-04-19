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

    /* BUTTON TAMBAH */
    .btn-add {
        background: #0f766e;
        color: white;
        padding: 10px 20px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: 0.2s;
    }

    .btn-add:hover { background: #0d5f59; color: white; }

    /* CARD CONTAINER */
    .box {
        background: white;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        border: 1px solid #e5e7eb;
        overflow-x: auto;
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

    /* BADGES STATUS */
    .badge-status {
        padding: 4px 10px;
        border-radius: 99px;
        font-size: 11px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .status-clear { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
    .status-kurang { background: #fef3c7; color: #92400e; border: 1px solid #fde68a; }
    .status-pending { background: #f3f4f6; color: #374151; border: 1px solid #d1d5db; }
    .status-lunas { background: #dcfce7; color: #15803d; font-weight: 800; }

    /* ACTION BUTTONS */
    .action-group {
        display: flex;
        gap: 6px;
        align-items: center;
        flex-wrap: wrap;
    }

    .btn-action {
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        color: white;
        border: none;
        display: inline-flex;
        align-items: center;
    }

    .btn-info { background: #3b82f6; }
    .btn-warning { background: #f59e0b; }
    .btn-danger { background: #ef4444; cursor: pointer; }
    .btn-pay { background: #10b981; }

    /* IMAGE THUMBNAIL */
    .img-doc {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 6px;
        cursor: pointer;
        border: 1px solid #e5e7eb;
        transition: 0.2s;
    }

    .img-doc:hover { transform: scale(1.1); }

    /* MODAL FOR IMAGE ZOOM */
    #imageModal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0; top: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.85);
        align-items: center;
        justify-content: center;
    }
</style>

<div class="page-wrapper">
    
    <div class="page-header">
        <h2 class="page-title">Data Serah Terima</h2>
        <a href="{{ route('serah-terima.create') }}" class="btn-add">+ Tambah Serah Terima</a>
    </div>

    @if(session('success'))
        <div style="background: #d1fae5; color: #065f46; padding: 12px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #a7f3d0; font-size: 14px;">
            {{ session('success') }}
        </div>
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
                    <th>Status</th>
                    <th>Nominal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td style="white-space: nowrap;">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ Str::limit($item->keterangan, 30) }}</td>
                    <td>
                        @if($item->dokumentasi)
                            <img src="{{ asset('storage/'.$item->dokumentasi) }}" 
                                 class="img-doc" 
                                 onclick="openZoom(this.src)" 
                                 alt="Doc">
                        @else
                            <span style="color: #9ca3af; font-size: 11px;">No Photo</span>
                        @endif
                    </td>
                    <td><span style="font-family: monospace; font-weight: bold;">{{ $item->berita_acara }}</span></td>
                    <td>
                        @if($item->clear)
                            <span class="badge-status status-clear">Clear</span>
                        @elseif($item->ada_kurang)
                            <span class="badge-status status-kurang">Kurang</span>
                        @else
                            <span class="badge-status status-pending">Pending</span>
                        @endif
                    </td>
                    <td style="font-weight: 600; color: #111827;">
                        Rp {{ number_format($item->nominal_pembayaran, 0, ',', '.') }}
                    </td>
                    <td>
                        <div class="action-group">
                            <a href="{{ route('serah-terima.edit', $item->id) }}" class="btn-action btn-warning">Edit</a>

                            <form action="{{ route('serah-terima.destroy', $item->id) }}" method="POST" style="margin:0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus data ini?')" class="btn-action btn-danger">Hapus</button>
                            </form>

                            @auth
                                @if(auth()->user()->role === 'admin')
                                    @if(!$item->pembayaran)
                                        <a href="{{ route('pembayaran.create', $item->id) }}" class="btn-action btn-pay">
                                            💰 Bayar
                                        </a>
                                    @else
                                        <span class="badge-status status-lunas">LUNAS</span>
                                    @endif
                                @endif
                            @endauth
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

<div id="imageModal" onclick="closeZoom()">
    <img id="imgZoomed" style="max-width: 90%; max-height: 90%; border-radius: 8px; box-shadow: 0 0 30px rgba(0,0,0,0.5);">
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