<x-app-layout>

<style>
        /* RESET & BASE */
    * {
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
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

    /* GRID SYSTEM */
    .cctv-grid {
        display: grid;
        /* Menggunakan 3 kolom pada layar besar, 2 pada tablet, 1 pada HP */
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 20px;
    }

    /* CARD STYLING */
    .cctv-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border: 1px solid #e5e7eb;
        position: relative;
        transition: transform 0.2s;
    }

    .cctv-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    /* HEADER DALAM CARD */
    .card-info {
        padding: 12px 15px;
        border-bottom: 1px solid #f3f4f6;
        padding-right: 45px; /* Memberi ruang agar teks tidak tertutup tombol X */
    }

    .cctv-title {
        font-size: 15px;
        font-weight: 700;
        color: #111827;
        margin: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .cctv-location {
        font-size: 12px;
        color: #6b7280;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* VIDEO CONTAINER */
    .video-container {
        position: relative;
        width: 100%;
        padding-top: 56.25%; /* 16:9 Aspect Ratio */
        background: #000;
    }

    .video-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: none;
    }

    /* OVERLAY LIVE INDICATOR */
    .live-status {
        position: absolute;
        bottom: 10px;
        left: 10px;
        background: rgba(0, 0, 0, 0.6);
        color: #10b981;
        padding: 2px 8px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .dot {
        height: 8px;
        width: 8px;
        background-color: #10b981;
        border-radius: 50%;
        display: inline-block;
        animation: blink 1.5s infinite;
    }

    @keyframes blink {
        0% { opacity: 1; }
        50% { opacity: 0.3; }
        100% { opacity: 1; }
    }

    /* TOMBOL HAPUS */
    .btn-delete-cctv {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(239, 68, 68, 0.9);
        color: white;
        border: none;
        width: 28px;
        height: 28px;
        border-radius: 6px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 20;
        transition: 0.2s;
    }

    .btn-delete-cctv:hover { background: #dc2626; transform: scale(1.1); }

</style>

<div class="page-wrapper">
    <div class="page-header">
        <div>
            <h2 style="font-size: 24px; font-weight: 800; color: #111827; margin: 0;">Monitoring CCTV</h2>
            <p style="color: #6b7280; font-size: 14px;">Pemantauan unit operasional secara real-time.</p>
        </div>
        <a href="{{ route('cctv.create') }}" class="btn" style="background: #0f766e; color: white; padding: 10px 20px; border-radius: 8px; font-weight: 600; text-decoration: none;">
            + Tambah CCTV
        </a>
    </div>

    <div class="cctv-grid">
        @foreach($data as $item)
        @php
            // Logika untuk memastikan URL adalah format embed yang benar
            // Mengambil Video ID dari URL (baik format embed maupun nonton biasa)
            $videoId = '';
            if (preg_match('/embed\/([^?]+)/', $item->url, $matches)) {
                $videoId = $matches[1];
            } elseif (preg_match('/v=([^&]+)/', $item->url, $matches)) {
                $videoId = $matches[1];
            }
            
            // Format ulang URL agar selalu valid untuk Iframe
            $embedUrl = "https://www.youtube.com/embed/{$videoId}?autoplay=1&mute=1&loop=1&playlist={$videoId}&rel=0";
        @endphp

        <div class="cctv-card">
            <form action="{{ route('cctv.destroy', $item->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete-cctv" onclick="return confirm('Hapus CCTV ini?')">✕</button>
            </form>

            <div class="card-info">
                <h5 class="cctv-title">{{ $item->nama }}</h5>
                <span class="cctv-location">📍 {{ $item->lokasi }}</span>
            </div>

            <div class="video-container">
                @if($videoId)
                    <iframe 
                        src="{{ $embedUrl }}" 
                        allow="autoplay; encrypted-media" 
                        allowfullscreen>
                    </iframe>
                @else
                    <div style="color: white; display: flex; align-items: center; justify-content: center; height: 100%; font-size: 12px; text-align: center; padding: 20px;">
                        URL Video Tidak Valid
                    </div>
                @endif
                
                <div class="live-status">
                    <span class="dot"></span> LIVE
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

</x-app-layout>