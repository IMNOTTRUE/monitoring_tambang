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
        text-align: left;
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

    /* DRAG & DROP AREA */
    #drop-area {
        border: 2px dashed #d1d5db;
        border-radius: 12px;
        padding: 40px 20px;
        text-align: center;
        background: #f9fafb;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 200px;
    }

    #drop-area.highlight {
        border-color: #0f766e;
        background-color: #f0fdfa;
    }

    #drop-area p {
        margin-top: 10px;
        font-size: 14px;
        color: #6b7280;
    }

    /* PREVIEW IMAGE */
    .preview-container {
        margin-top: 15px;
        text-align: center;
    }

    #imagePreview {
        max-width: 100%;
        max-height: 250px;
        border-radius: 8px;
        display: none;
        border: 2px solid #e5e7eb;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
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

    .btn-save {
        background: #0f766e;
        color: white;
        padding: 12px 30px;
        border-radius: 6px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: background 0.2s;
    }

    .btn-save:hover { background: #0d5f59; }

    .btn-cancel {
        background: #ffffff;
        color: #374151;
        padding: 12px 30px;
        border-radius: 6px;
        font-weight: 600;
        text-decoration: none;
        border: 1px solid #d1d5db;
    }

    .btn-cancel:hover { background: #f9fafb; }

    /* ERRORS */
    .alert-error {
        background: #fee2e2;
        border-left: 4px solid #ef4444;
        color: #991b1b;
        padding: 16px;
        margin-bottom: 24px;
        border-radius: 4px;
    }

    @media (max-width: 768px) {
        .form-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="page-wrapper">
    
    <div class="page-header">
        <h2 class="page-title">Tambah Pengiriman Baru</h2>
        <p style="color: #6b7280; font-size: 14px;">Lengkapi formulir di bawah untuk mencatat data pengiriman logistik tambang.</p>
    </div>

    <div class="box">
        @if ($errors->any())
            <div class="alert-error">
                <strong>Oops! Terjadi kesalahan input:</strong>
                <ul style="margin-top: 5px; font-size: 13px; margin-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pengiriman.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-grid">
                
                <div>
                    <div class="form-group">
                        <label>Tanggal Transaksi</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="form-group">
                        <label>Nominal Pembayaran (Rp)</label>
                        <input type="number" name="nominal_pembayaran" class="form-control" placeholder="Masukkan angka saja..." required>
                    </div>

                    <div class="form-group">
                        <label>Nomor Berita Acara</label>
                        <input type="text" name="berita_acara" class="form-control" placeholder="Contoh: Sesuai/tidak" required>
                    </div>

                    <div class="form-group">
                        <label>Keterangan Tambahan</label>
                        <textarea name="keterangan" class="form-control" rows="4" placeholder="Tuliskan detail pengiriman atau catatan lokasi..."></textarea>
                    </div>
                </div>

                <div>
                    <div class="form-group">
                        <label>Dokumentasi Foto</label>
                        <div id="drop-area">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                            
                            <p id="drop-text">Tarik & letakkan gambar di sini atau <strong>klik untuk pilih file</strong></p>
                            <input type="file" name="dokumentasi" id="fileInput" hidden accept="image/*">
                        </div>
                    </div>

                    <div class="preview-container">
                        <img id="imagePreview" src="#" alt="Preview Gambar">
                    </div>
                </div>

            </div>

            <div class="btn-container">
                <a href="{{ route('pengiriman.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-save">Simpan Data Pengiriman</button>
            </div>
        </form>
    </div>

</div>

<script>
    const dropArea = document.getElementById('drop-area');
    const fileInput = document.getElementById('fileInput');
    const preview = document.getElementById('imagePreview');
    const dropText = document.getElementById('drop-text');

    // Klik area untuk pilih file
    dropArea.addEventListener('click', () => fileInput.click());

    // Highlight saat drag file di atas area
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

    // Handle file drop
    dropArea.addEventListener('drop', (e) => {
        const dt = e.dataTransfer;
        const files = dt.files;
        fileInput.files = files; // Sinkronkan ke input tersembunyi
        handleFiles(files);
    });

    // Handle file dari input manual
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