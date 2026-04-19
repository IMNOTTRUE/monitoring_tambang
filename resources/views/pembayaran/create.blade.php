<x-app-layout>

<style>
    .page-wrapper {
        padding: 24px;
        background-color: #f8f9fa;
        min-height: 100vh;
    }

    .box {
        background: #ffffff;
        border-radius: 12px;
        padding: 28px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border: 1px solid #e5e7eb;
        max-width: 800px;
        margin: 0 auto;
    }

    .page-header {
        margin-bottom: 24px;
        text-align: center;
    }

    .page-title {
        font-size: 24px;
        font-weight: bold;
        color: #111827;
    }

    /* INFO CARD */
    .info-payment-card {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .info-label {
        font-size: 12px;
        color: #15803d;
        font-weight: bold;
        text-transform: uppercase;
        display: block;
    }

    .info-value {
        font-size: 16px;
        font-weight: 700;
        color: #111827;
    }

    /* FORM STYLING */
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
        border-color: #059669;
        box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
    }

    .form-control[disabled] {
        background-color: #f3f4f6;
        cursor: not-allowed;
    }

    /* UPLOAD & PREVIEW */
    .upload-area {
        border: 2px dashed #d1d5db;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        background: #f9fafb;
    }

    #preview {
        margin-top: 15px;
        max-width: 100%;
        max-height: 300px;
        border-radius: 6px;
        border: 1px solid #e5e7eb;
        display: none;
    }

    /* BUTTONS */
    .btn-container {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 30px;
    }

    .btn-submit {
        background: #059669;
        color: white;
        padding: 12px 32px;
        border-radius: 8px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: background 0.2s;
    }

    .btn-submit:hover { background: #047857; }

    .btn-back {
        background: #ffffff;
        color: #374151;
        padding: 12px 32px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        border: 1px solid #d1d5db;
    }
</style>

<div class="page-wrapper">
    <div class="page-header">
        <h2 class="page-title">Konfirmasi Pembayaran</h2>
        <p style="color: #6b7280; font-size: 14px;">Silakan unggah bukti transfer untuk menyelesaikan transaksi.</p>
    </div>

    <div class="box">
        <div class="info-payment-card">
            <div>
                <span class="info-label">Keterangan Serah Terima</span>
                <span class="info-value">{{ $serah->keterangan ?? '-' }}</span>
            </div>
            <div style="text-align: right;">
                <span class="info-label">Berita Acara</span>
                <span class="info-value" style="font-family: monospace;">{{ $serah->berita_acara }}</span>
            </div>
        </div>

        <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <input type="hidden" name="serah_terima_id" value="{{ $serah->id }}">

            <div class="form-group">
                <label>Nominal yang Harus Dibayar (Rp)</label>
                <input type="number" 
                       name="nominal" 
                       class="form-control" 
                       value="{{ $serah->nominal_pembayaran }}" 
                       placeholder="Masukkan jumlah bayar" 
                       required
                       style="font-weight: bold; color: #059669; font-size: 18px;">
            </div>

            <div class="form-group">
                <label>Tanggal Pembayaran</label>
                <input type="date" name="tanggal_bayar" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>

            <div class="form-group">
                <label>Bukti Pembayaran (JPG/PNG)</label>
                <div class="upload-area">
                    <input type="file" 
                           name="bukti_pembayaran" 
                           id="fileInput" 
                           class="form-control" 
                           accept="image/*" 
                           onchange="previewImage(event)" 
                           required>
                    
                    <div style="text-align: center;">
                        <img id="preview" src="#" alt="Preview Bukti">
                    </div>
                </div>
            </div>

            <div class="btn-container">
                <a href="{{ route('serah-terima.index') }}" class="btn-back">Batal</a>
                <button type="submit" class="btn-submit">Upload</button>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('preview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'inline-block';
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

</x-app-layout>