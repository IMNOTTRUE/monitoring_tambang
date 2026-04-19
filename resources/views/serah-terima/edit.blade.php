<x-app-layout>

<style>
    .page-wrapper {
        padding: 24px;
        background-color: #f8f9fa;
        min-height: 100vh;
    }

    .box {
        background: #ffffff;
        border-radius: 8px;
        padding: 24px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        border: 1px solid #e5e7eb;
        max-width: 900px;
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

    /* GRID FORM */
    .form-grid {
        display: grid;
        grid-template-columns: 1.2fr 0.8fr;
        gap: 24px;
    }

    .form-group {
        margin-bottom: 16px;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 14px;
    }

    .form-control:focus {
        outline: none;
        border-color: #0f766e;
        box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.1);
    }

    /* STATUS CHECKBOX STYLING */
    .status-container {
        display: flex;
        gap: 15px;
        margin-top: 5px;
    }

    .status-card {
        flex: 1;
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        cursor: pointer;
        transition: 0.2s;
        background: #f9fafb;
    }

    .status-card:hover { background: #f3f4f6; }

    .status-card input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: #0f766e;
    }

    /* IMAGE PREVIEW */
    .preview-section {
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 15px;
        background: #f9fafb;
    }

    .img-preview-box {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #d1d5db;
        background: #fff;
    }

    .btn-container {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 24px;
        padding-top: 20px;
        border-top: 1px solid #f3f4f6;
    }

    .btn-save {
        background: #0f766e;
        color: white;
        padding: 10px 24px;
        border-radius: 6px;
        font-weight: 600;
        border: none;
        cursor: pointer;
    }

    .btn-cancel {
        background: #ffffff;
        color: #374151;
        padding: 10px 24px;
        border-radius: 6px;
        font-weight: 600;
        text-decoration: none;
        border: 1px solid #d1d5db;
    }

    @media (max-width: 768px) {
        .form-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="page-wrapper">
    <div class="page-header">
        <h2 class="page-title">Update Data Serah Terima</h2>
    </div>

    <div class="box">
        <form action="{{ route('serah-terima.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div>
                    <div class="form-group">
                        <label>Tanggal Serah Terima</label>
                        <input type="date" name="tanggal" value="{{ $data->tanggal }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Nomor Berita Acara</label>
                        <input type="text" name="berita_acara" value="{{ $data->berita_acara }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Status Kondisi</label>
                        <div class="status-container">
                            <label class="status-card">
                                <input type="checkbox" name="clear" {{ $data->clear ? 'checked' : '' }}>
                                <span style="font-size: 14px; font-weight: 600; color: #059669;">✅ Clear</span>
                            </label>
                            <label class="status-card">
                                <input type="checkbox" name="ada_kurang" {{ $data->ada_kurang ? 'checked' : '' }}>
                                <span style="font-size: 14px; font-weight: 600; color: #d97706;">⚠️ Ada Kurang</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Nominal Pembayaran (Rp)</label>
                        <input type="number" name="nominal_pembayaran" value="{{ $data->nominal_pembayaran }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3">{{ $data->keterangan }}</textarea>
                    </div>
                </div>

                <div>
                    <div class="form-group">
                        <label>Update Dokumentasi</label>
                        <div class="preview-section">
                            <div style="margin-bottom: 10px; text-align: center;">
                                <span style="font-size: 11px; color: #6b7280; display: block; margin-bottom: 5px;">FOTO SAAT INI</span>
                                @if($data->dokumentasi)
                                    <img src="{{ asset('storage/'.$data->dokumentasi) }}" class="img-preview-box" id="oldPreview">
                                @else
                                    <div class="img-preview-box" style="display: flex; align-items: center; justify-content: center; background: #eee; color: #aaa;">Belum ada foto</div>
                                @endif
                            </div>

                            <input type="file" name="dokumentasi" id="fileInput" class="form-control">
                            
                            <div id="newPreviewContainer" style="display: none; margin-top: 15px; text-align: center;">
                                <span style="font-size: 11px; color: #0f766e; display: block; margin-bottom: 5px;">PREVIEW BARU</span>
                                <img id="imagePreview" class="img-preview-box" style="border-color: #0f766e;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn-container">
                <a href="{{ route('serah-terima.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-save">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('fileInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('imagePreview');
        const container = document.getElementById('newPreviewContainer');
        const oldPreview = document.getElementById('oldPreview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                container.style.display = 'block';
                if(oldPreview) oldPreview.style.opacity = "0.5";
            }
            reader.readAsDataURL(file);
        }
    });
</script>

</x-app-layout>