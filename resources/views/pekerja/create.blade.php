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
        max-width: 700px;
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
        margin-bottom: 5px;
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
        border-color: #0f766e;
        box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.1);
    }

    /* GRID FOR TWO COLUMNS */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    /* BUTTONS */
    .btn-container {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 32px;
        padding-top: 20px;
        border-top: 1px solid #f3f4f6;
    }

    .btn-save {
        background: #0f766e;
        color: white;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: background 0.2s;
    }

    .btn-save:hover { background: #0d5f59; }

    .btn-back {
        background: #ffffff;
        color: #374151;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        border: 1px solid #d1d5db;
        transition: background 0.2s;
    }

    .btn-back:hover { background: #f9fafb; }

    @media (max-width: 640px) {
        .form-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="page-wrapper">
    <div class="page-header">
        <h2 class="page-title">Registrasi Pekerja Baru</h2>
        <p style="color: #6b7280; font-size: 14px;">Lengkapi data personil untuk penempatan di unit operasional.</p>
    </div>

    <div class="box">
        <form action="{{ route('pekerja.store') }}" method="POST">
            @csrf

            <div class="form-grid">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama terang" required>
                </div>

                <div class="form-group">
                    <label>Jabatan</label>
                    <input type="text" name="jabatan" class="form-control" placeholder="Contoh: Admin, Operator, Driver" required>
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label>Nomor HP / WhatsApp</label>
                    <input type="text" name="no_hp" class="form-control" placeholder="08123456789" required>
                </div>

                <div class="form-group">
                    <label>Lokasi Penempatan</label>
                    <select name="lokasi" class="form-control" required>
                        <option value="" disabled selected>-- Pilih Lokasi --</option>
                        <option value="Jogja">📍 Jogja</option>
                        <option value="Gresik">📍 Gresik</option>
                        <option value="Belitung">📍 Belitung</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Alamat Domisili</label>
                <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat lengkap sesuai KTP/Domisili" required></textarea>
            </div>
            <div class="form-group">
            <label>Gaji</label>
            <input type="number" name="gaji" class="form-control" required>
        </div>
            <div class="btn-container">
                <a href="{{ route('pekerja.index') }}" class="btn-back">Kembali</a>
                <button type="submit" class="btn-save">Simpan Data Pekerja</button>
            </div>
        </form>
    </div>
</div>

</x-app-layout>