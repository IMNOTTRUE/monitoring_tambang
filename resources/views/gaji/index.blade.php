<x-app-layout>
<style>
    .gaji-container { padding: 30px; background: #f8f9fa; min-height: 100vh; font-family: 'Inter', sans-serif; }
    
    .card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: 1px solid #edf2f7;
        margin-bottom: 30px;
    }

    .card h2 { 
        margin-top: 0; 
        margin-bottom: 20px; 
        color: #0f172a; 
        font-weight: 800;
        border-bottom: 2px solid #f1f5f9;
        padding-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* TABLE STYLING */
    .custom-table { width: 100%; border-collapse: collapse; }
    .custom-table thead tr { font-size: 12px; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; }
    .custom-table th { padding: 12px 15px; text-align: left; border-bottom: 2px solid #f1f5f9; }
    .custom-table td { padding: 15px; border-bottom: 1px solid #f1f5f9; color: #475569; font-size: 14px; }
    
    .text-id { font-weight: bold; color: #64748b; width: 40px; }
    .emp-name { font-weight: 700; color: #1e293b; }
    .loc-tag { font-size: 12px; color: #64748b; background: #f1f5f9; padding: 2px 8px; border-radius: 4px; }

    /* STATUS BADGES */
    .badge { padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; display: inline-flex; align-items: center; gap: 5px; }
    .badge-success { background: #dcfce7; color: #15803d; }
    .badge-warning { background: #fee2e2; color: #b91c1c; }

    /* BUTTONS */
    .btn-pay {
        background: #2563eb; color: white; border: none; padding: 8px 16px; border-radius: 8px;
        font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.2s;
    }
    .btn-pay:hover { background: #1d4ed8; transform: translateY(-2px); }
    .btn-disabled { background: #f1f5f9; color: #94a3b8; border: none; padding: 8px 16px; border-radius: 8px; font-size: 13px; cursor: not-allowed; }

    .text-nominal { font-weight: 700; color: #059669; text-align: right; }
</style>

<div class="gaji-container">
    
    <div style="margin-bottom: 25px;">
        <h2 style="font-weight: 800; color: #0f172a; margin: 0;">Manajemen Penggajian</h2>
        <p style="color: #64748b;">Kelola dan pantau pembayaran gaji karyawan PT. Kapuas Prima Naiga.</p>
    </div>

    <div class="card">
        <h2><span style="font-size: 24px;">👷</span> Daftar Karyawan & Status Bayar</h2>
        <table class="custom-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Karyawan</th>
                    <th>Lokasi Kerja</th>
                    <th>Status Gaji</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pekerja as $item)
                @php
                    $sudah = \App\Models\PembayaranGaji::where('pekerja_id', $item->id)
                        ->where('bulan', $bulan)
                        ->where('tahun', $tahun)
                        ->first();
                @endphp
                <tr>
                    <td class="text-id">{{ $loop->iteration }}</td>
                    <td>
                        <div class="emp-name">{{ $item->nama }}</div>
                        <small style="color: #94a3b8;">ID: PEK-{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}</small>
                    </td>
                    <td><span class="loc-tag">{{ $item->lokasi }}</span></td>
                    <td>
                        @if($sudah)
                            <span class="badge badge-success">● Sudah Dibayar</span>
                        @else
                            <span class="badge badge-warning">● Belum Terbayar</span>
                        @endif
                    </td>
                    <td align="right">
                        @if(!$sudah)
                        <form method="POST" action="{{ route('gaji.store') }}">
                            @csrf
                            <input type="hidden" name="pekerja_id" value="{{ $item->id }}">
                            <input type="hidden" name="lokasi" value="{{ $item->lokasi }}">
                            <input type="number" name="nominal" value="{{ $item->gaji }}">
                            <button type="submit" class="btn-pay">Bayar Gaji</button>
                        </form>
                        @else
                            <button class="btn-disabled" disabled>Selesai</button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card">
        <h2><span style="font-size: 24px;">📄</span> Rekap Riwayat Gaji</h2>
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Periode</th>
                    <th>Tahun</th>
                    <th style="text-align: right;">Nominal Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td class="emp-name">{{ $item->pekerja->nama }}</td>
                    <td><span class="badge" style="background: #eff6ff; color: #1d4ed8;">Bulan {{ $item->bulan }}</span></td>
                    <td>{{ $item->tahun }}</td>
                    <td class="text-nominal">Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
                @if($data->isEmpty())
                <tr>
                    <td colspan="4" align="center" style="padding: 40px; color: #94a3b8;">Belum ada riwayat pembayaran bulan ini.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

</div>
</x-app-layout>