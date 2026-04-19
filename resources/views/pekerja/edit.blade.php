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

    /* PROFILE HEADER IN FORM */
    .edit-profile-header {
        display: flex;
        align-items: center;
        gap: 20px;
        padding-bottom: 24px;
        margin-bottom: 24px;
        border-bottom: 1px solid #f3f4f6;
    }

    .profile-avatar {
        width: 60px;
        height: 60px;
        background: #0f766e;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: bold;
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

    /* BUTTONS */
    .btn-container {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 32px;
    }

    .btn-update {
        background: #0f766e;
        color: white;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: background 0.2s;
    }

    .btn-update:hover { background: #0d5f59; }

    .btn-back {
        background: #ffffff;
        color: #374151;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        border: 1px solid #d1d5db;
    }
</style>

<div class="page-wrapper">
    <div class="box">
        <div class="edit-profile-header">
            <div class="profile-avatar">
                {{ substr($pekerja->nama, 0, 1) }}
            </div>
            <div>
                <h2 style="font-size: 20px; font-weight: 800; color: #111827; margin: 0;">Edit Data Pekerja</h2>
                <p style="color: #6b7280; font-size: 14px; margin: 0;">Memperbarui informasi untuk <strong>{{ $pekerja->nama }}</strong></p>
            </div>
        </div>

        <form action="{{ route('pekerja.update', $pekerja->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ $pekerja->nama }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Jabatan / Posisi</label>
                    <input type="text" name="jabatan" value="{{ $pekerja->jabatan }}" class="form-control" required>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label>Nomor WhatsApp/HP</label>
                    <input type="text" name="no_hp" value="{{ $pekerja->no_hp }}" class="form-control" placeholder="0812..." required>
                </div>

                <div class="form-group">
                    <label>Lokasi Penempatan</label>
                    <select name="lokasi" class="form-control" required>
                        <option value="Jogja" {{ $pekerja->lokasi == 'Jogja' ? 'selected' : '' }}>📍 Jogja</option>
                        <option value="Gresik" {{ $pekerja->lokasi == 'Gresik' ? 'selected' : '' }}>📍 Gresik</option>
                        <option value="Belitung" {{ $pekerja->lokasi == 'Belitung' ? 'selected' : '' }}>📍 Belitung</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Alamat Lengkap</label>
                <textarea name="alamat" class="form-control" rows="3" required>{{ $pekerja->alamat }}</textarea>
            </div>

            <div class="btn-container">
                <a href="{{ route('pekerja.index') }}" class="btn-back">Batal</a>
                <button type="submit" class="btn-update">Update Data Pekerja</button>
            </div>
        </form>
    </div>
</div>

</x-app-layout>