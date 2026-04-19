<x-app-layout>

<style>
    .page-wrapper {
        padding: 40px 24px;
        background-color: #f8f9fa;
        min-height: 100vh;
    }

    .box {
        background: #ffffff;
        border-radius: 12px;
        padding: 32px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border: 1px solid #e5e7eb;
        max-width: 600px;
        margin: 0 auto;
    }

    .page-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .page-title {
        font-size: 24px;
        font-weight: bold;
        color: #111827;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }

    .form-control {
        width: 100%;
        padding: 12px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 15px;
        transition: all 0.2s;
    }

    .form-control:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    /* TIPS BOX */
    .url-hint {
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        padding: 12px;
        border-radius: 8px;
        margin-top: 8px;
        font-size: 12px;
        color: #1e40af;
    }

    /* BUTTONS */
    .btn-container {
        display: flex;
        gap: 12px;
        margin-top: 32px;
    }

    .btn-save {
        flex: 2;
        background: #2563eb; /* Biru agar kontras dengan hijau operasional */
        color: white;
        padding: 14px;
        border-radius: 8px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: background 0.2s;
    }

    .btn-save:hover { background: #1d4ed8; }

    .btn-back {
        flex: 1;
        background: #ffffff;
        color: #374151;
        padding: 14px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        border: 1px solid #d1d5db;
        text-align: center;
    }

    .btn-back:hover { background: #f9fafb; }
</style>

<div class="page-wrapper">
    <div class="page-header">
        <h2 class="page-title">Registrasi CCTV Baru</h2>
        <p style="color: #6b7280; font-size: 14px; margin-top: 4px;">Integrasikan stream CCTV baru ke dalam dashboard monitoring.</p>
    </div>

    <div class="box">
        <form action="{{ route('cctv.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>🏷️ Nama Perangkat CCTV</label>
                <input type="text" name="nama" class="form-control" placeholder="Contoh: Area Gudang A, Pintu Utama" required>
            </div>

            <div class="form-group">
                <label>📍 Lokasi Penempatan</label>
                <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Belitung, Gresik, Jogja" required>
            </div>

            <div class="form-group">
                <label>🔗 URL Streaming (YouTube Embed)</label>
                <input type="text" name="url" class="form-control" placeholder="https://www.youtube.com/embed/..." required>
                
                <div class="url-hint">
                    <strong>💡 Tips URL:</strong><br>
                    Gunakan format <code>embed</code> untuk hasil terbaik. <br>
                    Contoh: <em>https://www.youtube.com/embed/ID_VIDEO</em>
                </div>
            </div>

            <div class="btn-container">
                <a href="{{ route('cctv.index') }}" class="btn-back">Batal</a>
                <button type="submit" class="btn-save">Aktifkan CCTV</button>
            </div>
        </form>
    </div>
</div>

</x-app-layout>