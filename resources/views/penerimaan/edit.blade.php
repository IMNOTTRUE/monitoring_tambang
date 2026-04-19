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
        grid-template-columns: 1fr 1fr;
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
        transition: border-color 0.2s;
    }

    .form-control:focus {
        outline: none;
        border-color: #0f766e;
        box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.1);
    }

    /* IMAGE SECTION */
    .image-preview-wrapper {
        display: flex;
        gap: 15px;
        align-items: flex-start;
        margin-top: 10px;
    }

    .image-box {
        flex: 1;
        text-align: center;
    }

    .image-box span {
        display: block;
        font-size: 11px;
        color: #6b7280;
        margin-bottom: 5px;
        text-transform: uppercase;
        font-weight: bold;
    }

    .img-edit-preview {
        width: 100%;
        height: 160px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #e5e7eb;
    }

    /* BUTTONS */
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
        background: #f3f4f6;
        color: #374151;
        padding: 10px 24px;
        border-radius: 6px;
        font-weight: 600;
        text-decoration: none;
        border: 1px solid #d1d5db;
    }

    .alert-error {
        background: #fee2e2;
        border-left: 4px solid #ef4444;
        color: #991b1b;
        padding: 16px;
        margin-bottom: 20px;
        border-radius: 4px;
    }

    @media (max-width: 640px) {
        .form-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="page-wrapper">
    <div class="page-header">
        <h2 class="page-title">Edit Data Penerimaan</h2>
    </div>

    <div class="box">
        @if ($errors->any())
            <div class="alert-error">
                <strong>Oops! Ada kesalahan:</strong>
                <ul style="margin-top: 5px; font-size: 13px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('penerimaan.update', $penerimaan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div>
                    <div class="form-group">
                        <label>Tanggal Penerimaan</label>
                        <input type="date" name="tanggal" value="{{ $penerimaan->tanggal }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Nominal Pembayaran (Rp)</label>
                        <input type="number" name="nominal_pembayaran" value="{{ $penerimaan->nominal_pembayaran }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Berita Acara</label>
                        <input type="text" name="berita_acara" value="{{ $penerimaan->berita_acara }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3">{{ $penerimaan->keterangan }}</textarea>
                    </div>
                </div>

                <div>
                    <div class="form-group">
                        <label>Ganti Dokumentasi</label>
                        <input type="file" name="dokumentasi" id="previewImage" class="form-control">
                        <p style="font-size: 11px; color: #6b7280; margin-top: 4px;">*Biarkan kosong jika tidak ingin mengganti gambar.</p>
                    </div>

                    <div class="image-preview-wrapper">
                        <div class="image-box">
                            <span>Foto Lama</span>
                            @if($penerimaan->dokumentasi)
                                <img src="{{ asset('storage/'.$penerimaan->dokumentasi) }}" class="img-edit-preview" alt="Foto Lama">
                            @else
                                <div class="img-edit-preview" style="background: #f3f4f6; display: flex; align-items: center; justify-content: center; font-size: 10px; color: #9ca3af;">Tidak ada foto</div>
                            @endif
                        </div>

                        <div class="image-box" id="newPreviewContainer" style="display: none;">
                            <span style="color: #0f766e;">Preview Baru</span>
                            <img id="imagePreview" class="img-edit-preview" style="border-color: #0f766e;">
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn-container">
                <a href="{{ route('penerimaan.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-save">Update Data</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('previewImage').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('imagePreview');
        const container = document.getElementById('newPreviewContainer');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                container.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });
</script>

</x-app-layout>