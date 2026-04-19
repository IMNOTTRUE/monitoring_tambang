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
        max-width: 1000px;
        margin: 0 auto;
    }

    .page-header {
        margin-bottom: 24px;
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
        gap: 30px;
    }

    .form-group {
        margin-bottom: 18px;
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
        padding: 10px 12px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 14px;
        transition: all 0.2s;
    }

    .form-control:focus {
        outline: none;
        border-color: #0f766e;
        box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.1);
    }

    /* STATUS CHECKBOX CARDS */
    .status-options {
        display: flex;
        gap: 12px;
    }

    .status-card {
        flex: 1;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        cursor: pointer;
        background: #f9fafb;
        transition: 0.2s;
    }

    .status-card:hover { border-color: #0f766e; background: #f0fdfa; }

    .status-card input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: #0f766e;
    }

    /* DRAG & DROP AREA */
    #drop-area {
        border: 2px dashed #d1d5db;
        border-radius: 12px;
        padding: 40px 20px;
        text-align: center;
        background: #f9fafb;
        cursor: pointer;
        transition: all 0.3s ease;
        min-height: 200px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    #drop-area.highlight {
        border-color: #0f766e;
        background-color: #f0fdfa;
    }

    /* IMAGE PREVIEW */
    #preview {
        max-width: 100%;
        max-height: 250px;
        border-radius: 8px;
        display: none;
        margin-top: 15px;
        border: 2px solid #e5e7eb;
    }

    /* BUTTONS */
    .btn-container {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #f3f4f6;
    }

    .btn-save { background: #0f766e; color: white; padding: 12px 30px; border-radius: 6px; font-weight: 600; border: none; cursor: pointer; }
    .btn-cancel { background: #ffffff; color: #374151; padding: 12px 30px; border-radius: 6px; font-weight: 600; text-decoration: none; border: 1px solid #d1d5db; }

    @media (max-width: 768px) { .form-grid { grid-template-columns: 1fr; } }
</style>

<div class="page-wrapper">
    <div class="page-header">
        <h2 class="page-title">Tambah Serah Terima</h2>
        <p style="color: #6b7280; font-size: 14px;">Pastikan status kondisi barang sesuai dengan fisik saat serah terima.</p>
    </div>

    <div class="box">
        <form action="{{ route('serah-terima.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-grid">
                <div>
                    <div class="form-group">
                        <label>Tanggal Serah Terima</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                        @error('tanggal') <small style="color: #ef4444;">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group">
                        <label>Nomor Berita Acara</label>
                        <input type="text" name="berita_acara" class="form-control" placeholder="Sesuai/tidak" required>
                    </div>

                    <div class="form-group">
                        <label>Status Kondisi</label>
                        <div class="status-options">
                            <label class="status-card">
                                <input type="checkbox" name="clear">
                                <span style="font-size: 14px; font-weight: 600; color: #059669;">✅ Clear</span>
                            </label>
                            <label class="status-card">
                                <input type="checkbox" name="ada_kurang">
                                <span style="font-size: 14px; font-weight: 600; color: #d97706;">⚠️ Kurang</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Nominal Pembayaran (Rp)</label>
                        <input type="number" name="nominal_pembayaran" class="form-control" placeholder="0">
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3" placeholder="Tambahkan catatan jika ada..."></textarea>
                    </div>
                </div>

                <div>
                    <div class="form-group">
                        <label>Dokumentasi Serah Terima</label>
                        <div id="drop-area">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 10px;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                            <p id="drop-text" style="font-size: 14px; color: #6b7280;">Tarik foto ke sini atau <strong>klik untuk pilih</strong></p>
                            <input type="file" name="dokumentasi" id="fileInput" hidden accept="image/*">
                        </div>
                        @error('dokumentasi') <small style="color: #ef4444;">{{ $message }}</small> @enderror
                        
                        <div style="text-align: center;">
                            <img id="preview" src="" alt="Preview">
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn-container">
                <a href="{{ route('serah-terima.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-save">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

<script>
    const dropArea = document.getElementById('drop-area');
    const fileInput = document.getElementById('fileInput');
    const preview = document.getElementById('preview');
    const dropText = document.getElementById('drop-text');

    dropArea.addEventListener('click', () => fileInput.click());

    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, (e) => {
            e.preventDefault();
            dropArea.classList.add('highlight');
        }, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, (e) => {
            e.preventDefault();
            dropArea.classList.remove('highlight');
        }, false);
    });

    dropArea.addEventListener('drop', (e) => {
        const dt = e.dataTransfer;
        fileInput.files = dt.files;
        handleFiles(dt.files);
    });

    fileInput.addEventListener('change', function() {
        handleFiles(this.files);
    });

    function handleFiles(files) {
        const file = files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'inline-block';
                dropText.innerHTML = `File terpilih: <strong>${file.name}</strong>`;
            }
            reader.readAsDataURL(file);
        }
    }
</script>

</x-app-layout>