<x-app-layout>
<style>
    /* RESET & BASE */
    * { box-sizing: border-box; font-family: 'Inter', 'Segoe UI', sans-serif; }
    .page-wrapper { padding: 24px; background-color: #f8f9fa; min-height: 100vh; }

    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
    .page-title { font-size: 24px; font-weight: bold; color: #111827; margin: 0; }

    /* STATS CARDS */
    .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 24px; }
    .stat-card { background: white; padding: 20px; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
    .stat-label { font-size: 13px; color: #6b7280; font-weight: 600; text-transform: uppercase; display: block; margin-bottom: 8px; }
    .stat-value { font-size: 20px; font-weight: 800; font-family: 'JetBrains Mono', monospace; }

    /* FILTERS & ACTION */
    .toolbar {
        display: flex; justify-content: space-between; align-items: center;
        background: white; padding: 15px 20px; border-radius: 12px 12px 0 0;
        border: 1px solid #e5e7eb; border-bottom: none;
    }

    .form-select {
        padding: 8px 12px; border-radius: 8px; border: 1px solid #d1d5db;
        color: #374151; font-size: 14px; outline: none; transition: border 0.2s;
    }
    .form-select:focus { border-color: #0f766e; }

    .btn-add {
        background: #0f766e; color: white; padding: 10px 20px; border-radius: 8px;
        text-decoration: none; font-weight: 600; font-size: 14px; transition: 0.2s;
    }
    .btn-add:hover { background: #0d9488; transform: translateY(-1px); }

    /* TABLE */
    .box { background: white; border-radius: 0 0 12px 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #e5e7eb; overflow: hidden; }
    .data-table { width: 100%; border-collapse: collapse; font-size: 14px; }
    .data-table th { background: #f9fafb; color: #4b5563; font-weight: 600; text-align: left; padding: 15px; border-bottom: 1px solid #e5e7eb; }
    .data-table td { padding: 15px; border-bottom: 1px solid #f3f4f6; vertical-align: middle; }

    /* BADGES */
    .badge-kas { padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: bold; white-space: nowrap; }
    .badge-masuk { background: #dcfce7; color: #15803d; }
    .badge-keluar { background: #fee2e2; color: #b91c1c; }
    .lokasi-tag { background: #eff6ff; color: #1d4ed8; padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 800; text-transform: uppercase; }

    @media (max-width: 768px) { .stats-grid { grid-template-columns: 1fr; } .toolbar { flex-direction: column; gap: 15px; align-items: flex-start; } }
</style>

<div class="page-wrapper">
    <div class="page-header">
        <h2 class="page-title">📊 Laporan Kas Operasional</h2>
    </div>

    @php
        $totalMasuk = $data->where('jenis', 'masuk')->sum('nominal');
        $totalKeluar = $data->where('jenis', 'keluar')->sum('nominal');
        $saldo = $totalMasuk - $totalKeluar;
    @endphp

    <div class="stats-grid">
        <div class="stat-card">
            <span class="stat-label">Total Kas Masuk</span>
            <span class="stat-value" style="color: #059669;">Rp {{ number_format($totalMasuk, 0, ',', '.') }}</span>
        </div>
        <div class="stat-card">
            <span class="stat-label">Total Kas Keluar</span>
            <span class="stat-value" style="color: #dc2626;">Rp {{ number_format($totalKeluar, 0, ',', '.') }}</span>
        </div>
        <div class="stat-card" style="background: #0f766e; border: none;">
            <span class="stat-label" style="color: rgba(255,255,255,0.8);">Saldo Akhir</span>
            <span class="stat-value" style="color: white;">Rp {{ number_format($saldo, 0, ',', '.') }}</span>
        </div>
    </div>

    <div class="toolbar">
        <form method="GET" style="display: flex; gap: 15px; align-items: center;">
            <select name="lokasi" onchange="this.form.submit()" class="form-select">
                <option value="">📍 Semua Lokasi</option>
                <option value="jogja" {{ request('lokasi') == 'jogja' ? 'selected' : '' }}>Jogja</option>
                <option value="gresik" {{ request('lokasi') == 'gresik' ? 'selected' : '' }}>Gresik</option>
                <option value="belitung" {{ request('lokasi') == 'belitung' ? 'selected' : '' }}>Belitung</option>
            </select>
            <span style="color: #9ca3af; font-size: 13px; font-weight: 500;">
                {{ $data->count() }} Transaksi ditemukan
            </span>
        </form>
        <a href="{{ route('kas.create') }}" class="btn-add">+ Input Kas Baru</a>
    </div>

    <div class="box">
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Tanggal</th>
                    <th>Lokasi</th>
                    <th>Keterangan</th>
                    <th>Jenis</th>
                    <th style="text-align: right;">Nominal</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td style="color: #6b7280; white-space: nowrap;">
                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                    </td>
                    <td><span class="lokasi-tag">{{ $item->lokasi }}</span></td>
                    <td style="font-weight: 600; color: #1f2937;">{{ $item->keterangan }}</td>
                    <td>
                        @if($item->jenis == 'masuk')
                            <span class="badge-kas badge-masuk">⬇ Masuk</span>
                        @else
                            <span class="badge-kas badge-keluar">⬆ Keluar</span>
                        @endif
                    </td>
                    <td style="text-align: right; font-weight: 700; font-family: monospace; font-size: 15px;">
                        <span style="color: {{ $item->jenis == 'masuk' ? '#059669' : '#dc2626' }}">
                            {{ $item->jenis == 'masuk' ? '+' : '-' }} Rp {{ number_format($item->nominal, 0, ',', '.') }}
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <div style="display:flex; gap:8px; justify-content:center;">
                            <a href="{{ route('kas.edit', $item->id) }}" 
                                style="background:#2563eb; color:white; padding:6px 12px; border-radius:6px; font-size:12px; text-decoration:none; font-weight:600;">
                                Edit
                            </a>
                            <form action="{{ route('kas.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin hapus data kas ini?')" 
                                    style="background:#dc2626; color:white; padding:6px 12px; border:none; border-radius:6px; font-size:12px; font-weight:600; cursor:pointer;">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 60px; color: #9ca3af;">
                        <div style="font-size: 30px; margin-bottom: 10px;">📂</div>
                        Belum ada data kas terekam.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <a href="{{ route('kas.export') }}" class="btn-add" style="background:#16a34a;">
    ⬇ Export Excel
</a>
    </div>
</div>
</x-app-layout>