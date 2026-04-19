<x-app-layout>
<style>
    .form-container { padding: 30px; background: #f8f9fa; min-height: 100vh; font-family: 'Inter', sans-serif; }
    
    .card-form {
        max-width: 600px;
        margin: 0 auto;
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: 1px solid #edf2f7;
    }

    .card-form h2 { 
        margin-top: 0; 
        margin-bottom: 25px; 
        color: #0f172a; 
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 20px;
    }

    .form-group { margin-bottom: 20px; }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #475569;
        font-size: 14px;
    }

    /* INPUT STYLING */
    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        font-size: 14px;
        color: #1e293b;
        transition: all 0.3s;
        background-color: #fcfcfc;
    }

    .form-control:focus {
        outline: none;
        border-color: #facc15; /* Warna kuning untuk mode edit */
        background-color: white;
        box-shadow: 0 0 0 4px rgba(250, 204, 21, 0.1);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    /* BUTTON STYLING */
    .btn-update {
        width: 100%;
        background: #facc15;
        color: #1e293b;
        border: none;
        padding: 14px;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
    }

    .btn-update:hover {
        background: #eab308;
        transform: translateY(-2px);
    }

    .btn-cancel {
        display: block;
        text-align: center;
        margin-top: 15px;
        color: #64748b;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
    }
</style>

<div class="form-container">
    <div class="card-form">
        <h2>
            <span style="background: #fef9c3; padding: 10px; border-radius: 10px;">✏️</span>
            Edit Data Operasional
        </h2>

        <form method="POST" action="{{ route('operasional.update', $data->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Lokasi Operasional</label>
                <select name="lokasi" class="form-control">
                    <option value="Jogja" {{ $data->lokasi == 'Jogja' ? 'selected' : '' }}>Jogja</option>
                    <option value="Gresik" {{ $data->lokasi == 'Gresik' ? 'selected' : '' }}>Gresik</option>
                    <option value="Belitung" {{ $data->lokasi == 'Belitung' ? 'selected' : '' }}>Belitung</option>
                </select>
            </div>

            <div class="form-group">
                <label>Tanggal Transaksi</label>
                <input type="date" name="tanggal" class="form-control" value="{{ $data->tanggal }}">
            </div>

            <div class="form-group">
                <label>Nominal Pengeluaran</label>
                <div style="position: relative;">
                    <span style="position: absolute; left: 15px; top: 12px; color: #94a3b8; font-weight: 600;">Rp</span>
                    <input type="number" name="nominal" class="form-control" style="padding-left: 45px;" value="{{ $data->nominal }}">
                </div>
            </div>

            <div class="form-group">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control">{{ $data->keterangan }}</textarea>
            </div>

            <button type="submit" class="btn-update">
                <span>🔄</span> Perbarui Data
            </button>

            <a href="{{ route('operasional.index') }}" class="btn-cancel">Batal & Kembali</a>
        </form>
    </div>
</div>
</x-app-layout>