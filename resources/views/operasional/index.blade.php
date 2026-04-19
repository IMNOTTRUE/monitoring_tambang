<x-app-layout>
<style>
    .op-container { padding: 30px; background: #f8f9fa; min-height: 100vh; font-family: 'Inter', sans-serif; }
    
    .card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: 1px solid #edf2f7;
    }

    .header-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .btn-add {
        background: #2563eb; color: white; padding: 10px 20px; border-radius: 10px;
        text-decoration: none; font-weight: 700; font-size: 14px;
        transition: all 0.2s; display: flex; align-items: center; gap: 8px;
    }

    .btn-add:hover { background: #1d4ed8; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2); }

    /* TABLE STYLE */
    .custom-table { width: 100%; border-collapse: collapse; }
    .custom-table thead tr { font-size: 12px; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; }
    .custom-table th { padding: 15px; text-align: left; border-bottom: 2px solid #f1f5f9; }
    .custom-table td { padding: 15px; border-bottom: 1px solid #f1f5f9; color: #475569; font-size: 14px; }
    
    .text-id { font-weight: bold; color: #64748b; width: 40px; }
    .text-nominal { font-weight: 700; color: #1e293b; }
    .loc-badge { background: #f1f5f9; color: #475569; padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 700; }

    /* ACTION BUTTONS */
    .btn-action {
        padding: 6px 10px; border-radius: 8px; font-size: 14px; 
        text-decoration: none; display: inline-flex; align-items: center; 
        transition: all 0.2s; border: none; cursor: pointer;
    }
    .btn-edit { background: #fef9c3; color: #a16207; margin-right: 5px; }
    .btn-edit:hover { background: #facc15; color: #1e293b; }
    
    .btn-delete { background: #fee2e2; color: #b91c1c; }
    .btn-delete:hover { background: #ef4444; color: white; }
    
    /* ALERT */
    .alert-success {
        background: #dcfce7; color: #15803d; padding: 15px; border-radius: 12px;
        margin-bottom: 20px; border: 1px solid #bbf7d0; font-size: 14px; font-weight: 600;
    }
</style>

<div class="op-container">
    
    <div class="header-flex">
        <div>
            <h2 style="font-weight: 800; color: #0f172a; margin: 0;">💰 Pembayaran Operasional</h2>
            <p style="color: #64748b; margin-top: 5px;">Manajemen pengeluaran PT. Kapuas Prima Niaga.</p>
        </div>
        <a href="{{ route('operasional.create') }}" class="btn-add">
            <span>+</span> Tambah Operasional
        </a>
    </div>

    @if(session('success'))
    <div class="alert-success">
        ✅ {{ session('success') }}
    </div>
    @endif

    <div class="card">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Lokasi</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                    <th style="text-align: right;">Nominal</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($data as $item)
                <tr>
                    <td class="text-id">{{ $loop->iteration }}</td>
                    <td><span class="loc-badge">{{ $item->lokasi }}</span></td>
                    <td>
                        <div style="font-weight: 600; color: #1e293b;">{{ $item->keterangan }}</div>
                    </td>
                    <td>
                        <div style="color: #94a3b8; font-size: 13px;">
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                        </div>
                    </td>
                    <td align="right">
                        <span class="text-nominal">
                            <small style="font-weight: normal; color: #94a3b8; font-size: 11px;">Rp</small> 
                            {{ number_format($item->nominal, 0, ',', '.') }}
                        </span>
                    </td>
                    <td align="center">
                        <div style="display: flex; justify-content: center; gap: 5px;">
                            <a href="{{ route('operasional.edit', $item->id) }}" class="btn-action btn-edit" title="Edit Data">
                                ✏️
                            </a>

                            <form action="{{ route('operasional.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus permanen data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" title="Hapus Data">
                                    🗑️
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach

                @if($data->isEmpty())
                <tr>
                    <td colspan="6" align="center" style="padding: 60px; color: #94a3b8;">
                        <div style="font-size: 40px; margin-bottom: 10px;">📂</div>
                        Belum ada data operasional yang tercatat.
                    </td>   
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
</x-app-layout>