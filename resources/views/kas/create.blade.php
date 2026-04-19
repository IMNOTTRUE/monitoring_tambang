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
        border-color: #0f766e;
        box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.1);
    }

    /* KHUSUS NOMINAL */
    .input-nominal {
        font-size: 20px;
        font-weight: bold;
        color: #111827;
        font-family: monospace;
    }

    /* SELECT STYLING */
    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 20px;
    }

    /* BUTTONS */
    .btn-container {
        display: flex;
        gap: 12px;
        margin-top: 32px;
    }

    .btn-save {
        flex: 2;
        background: #0f766e;
        color: white;
        padding: 14px;
        border-radius: 8px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: background 0.2s;
        text-align: center;
    }

    .btn-save:hover { background: #0d5f59; }

    .btn-cancel {
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

    .btn-cancel:hover { background: #f9fafb; }
</style>

<div class="page-wrapper">
    <div class="page-header">
        <h2 class="page-title">Tambah Transaksi Kas</h2>
        <p style="color: #6b7280; font-size: 14px; margin-top: 4px;">Catat mutasi uang masuk atau keluar dengan teliti.</p>
    </div>

    <div class="box">
        <form action="{{ route('kas.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>📍 Lokasi Operasional</label>
                <select name="lokasi" class="form-control" required>
                    <option value="jogja">Jogja</option>
                    <option value="gresik">Gresik</option>
                    <option value="belitung">Belitung</option>
                </select>
            </div>

            <div class="form-group">
                <label>🔄 Jenis Transaksi</label>
                <select name="jenis" class="form-control" required>
                    <option value="masuk" style="color: #059669; font-weight: bold;">💰 Uang Masuk (Debit)</option>
                    <option value="keluar" style="color: #dc2626; font-weight: bold;">💸 Uang Keluar (Kredit)</option>
                </select>
            </div>

            <div class="form-group">
                <label>💵 Nominal (Rp)</label>
                <input type="number" name="nominal" class="form-control input-nominal" placeholder="0" required>
            </div>

            <div class="form-group">
                <label>📝 Keterangan</label>
                <input type="text" name="keterangan" class="form-control" placeholder="Contoh: Pembelian Bahan Baku, Penjualan Produk, dll" required>
            </div>

            <div class="form-group">
                <label>📅 Tanggal Transaksi</label>
                <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>

            <div class="btn-container">
                <a href="{{ route('kas.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-save">Simpan Transaksi</button>
            </div>
        </form>
    </div>
</div>

</x-app-layout>