<x-app-layout>

<style>
    .dashboard { padding: 30px; background: #f8f9fa; min-height: 100vh; }
    
    /* STATS HEADER */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .stat-card {
        background: white;
        padding: 20px;
        border-radius: 12px;
        border-left: 5px solid #2563eb;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .stat-card p { color: #64748b; font-size: 13px; margin: 0; font-weight: 600; text-transform: uppercase; }
    .stat-card h3 { color: #1e293b; font-size: 24px; margin: 5px 0 0 0; font-weight: 800; }

    /* GRID LAYOUT - Pastikan hanya ada satu pembungkus grid utama */
    .grid-container {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 25px;
    }

    /* CARD STYLING */
    .card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: 1px solid #edf2f7;
    }
    
    .card h4 { 
        margin-top: 0; 
        margin-bottom: 20px; 
        color: #0f172a; 
        border-bottom: 2px solid #f1f5f9;
        padding-bottom: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* TABLE IMPROVEMENT */
    table { width: 100%; border-collapse: collapse; }
    table tr td { 
        padding: 12px 8px; 
        border-bottom: 1px solid #f1f5f9; 
        font-size: 14px; 
        color: #475569;
    }
    
    .text-nominal { text-align: right; font-weight: 700; color: #0f172a; }
    .text-id { font-weight: bold; color: #64748b; width: 30px; }

    .badge-user {
        background: #e0e7ff;
        color: #4338ca;
        padding: 2px 8px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
    }

    .view-all { font-size: 12px; color: #2563eb; text-decoration: none; }

    small { display: block; line-height: 1.4; margin-top: 2px; }

    @media (max-width: 1024px) {
        .stats-row { grid-template-columns: 1fr 1fr; }
        .grid-container { grid-template-columns: 1fr; }
    }
</style>

<div class="dashboard">
    <div style="margin-bottom: 25px;">
        <h2 style="font-weight: 800; color: #0f172a;">Logistics Operations Dashboard</h2>
        <p style="color: #64748b;">Pantau arus logistik PT. Niaga Kapuas secara real-time.</p>
    </div>

    <div class="stats-row">
        <div class="stat-card" style="border-left-color: #2563eb;">
            <p>Total Pengiriman</p>
            <h3>{{ $pengiriman->count() }}</h3>
        </div>
        <div class="stat-card" style="border-left-color: #059669;">
            <p>Total Penerimaan</p>
            <h3>{{ $penerimaan->count() }}</h3>
        </div>
        <div class="stat-card" style="border-left-color: #d97706;">
            <p>Proses Pengeringan</p>
            <h3>{{ $pengeringan->count() }}</h3>
        </div>
        <div class="stat-card" style="border-left-color: #7c3aed;">
            <p>Serah Terima</p>
            <h3>{{ $serah->count() }}</h3>
        </div>
    </div>

    <div class="grid-container">
        
        <div class="card">
            <h4>
                <span>📦 Pengiriman Terbaru</span>
                <a href="{{ route('pengiriman.index') }}" class="view-all">Lihat Semua</a>
            </h4>
            <table>
                <thead>
                    <tr style="font-size: 12px; color: #94a3b8; border-bottom: 2px solid #f1f5f9;">
                        <th align="left">No</th>
                        <th align="left">Keterangan</th>
                        <th align="right">Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengiriman->take(5) as $item)
                    <tr>
                        <td class="text-id">{{ $loop->iteration }}</td>
                        <td>
                            <div style="font-weight: 600; color: #1e293b;">{{ Str::limit($item->keterangan, 35) }}</div>
                            <small style="color: #94a3b8;">{{ $item->created_at->diffForHumans() }}</small>
                        </td>
                        <td align="right">
                            <span class="badge-user">{{ $item->user->name}}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card">
            <h4>
                <span>📥 Penerimaan Terbaru</span>
                <a href="{{ route('penerimaan.index') }}" class="view-all">Lihat Semua</a>
            </h4>
            <table>
                <thead>
                    <tr style="font-size: 12px; color: #94a3b8; border-bottom: 2px solid #f1f5f9;">
                        <th align="left">No</th>
                        <th align="left">Info</th>
                        <th align="right">Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penerimaan->take(5) as $item)
                    <tr>
                        <td class="text-id">{{ $loop->iteration }}</td>
                        <td>
                            <div style="font-weight: 600; color: #1e293b;">{{ $item->keterangan ?? 'Penerimaan Material' }}</div>
                            <small style="color: #94a3b8;">{{ $item->tanggal }}</small>
                        </td>
                        <td align="right">
                            <span class="badge-user" style="background: #f1f5f9; color: #475569;">{{ $item->user->name}}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card">
            <h4>
                <span>🔥 Pengeringan Terbaru</span>
                <a href="{{ route('pengeringan.index') }}" class="view-all">Lihat Semua</a>
            </h4>
            <table>
                <thead>
                    <tr style="font-size: 12px; color: #94a3b8; border-bottom: 2px solid #f1f5f9;">
                        <th align="left">No</th>
                        <th align="left">Keterangan / BA</th>
                        <th align="right">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengeringan->take(5) as $item)
                    <tr>
                        <td class="text-id">{{ $loop->iteration }}</td>
                        <td>
                            <div style="font-weight: 600; color: #1e293b;">{{ $item->berita_acara ?? 'Proses Pengeringan' }}</div>
                            <small style="color: #64748b;">Oleh: {{ $item->user->name ?? 'bimo' }}</small>
                        </td>
                        <td class="text-nominal" style="color: #d97706;">
                            {{ number_format($item->quantity ?? 0, 0, ',', '.') }} <span style="font-size: 11px; color: #94a3b8;">Ton</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card">
            <h4>
                <span>📄 Serah Terima Terakhir</span>
                <a href="{{ route('serah-terima.index') }}" class="view-all">Lihat Semua</a>
            </h4>
            <table>
                <thead>
                    <tr style="font-size: 12px; color: #94a3b8; border-bottom: 2px solid #f1f5f9;">
                        <th align="left">No</th>
                        <th align="left">Keterangan</th>
                        <th align="right">Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($serah->take(5) as $item)
                    <tr>
                        <td class="text-id">{{ $loop->iteration }}</td>
                        <td>
                            <div style="font-weight: 600; color: #1e293b;">{{ Str::limit($item->keterangan, 30) }}</div>
                            <small style="color: #64748b;">User: {{ $item->user->name ?? 'bimo' }}</small>
                        </td>
                        <td class="text-nominal" style="color: #059669;">
                            <span style="font-size: 11px; color: #94a3b8; font-weight: normal;">Rp</span> 
                            {{ number_format($item->nominal_pembayaran, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div> </div>

</x-app-layout>