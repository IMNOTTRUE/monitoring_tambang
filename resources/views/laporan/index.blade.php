<x-app-layout>
<style>
    /* BASE STYLING */
    .page-wrapper {
        padding: 30px;
        background-color: #f8f9fa;
        min-height: 100vh;
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
    }

    .report-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #e5e7eb;
        flex-wrap: wrap;
        gap: 15px;
    }

    .report-title h2 {
        font-size: 26px;
        font-weight: 800;
        color: #111827;
        margin: 0;
    }

    .report-title p {
        color: #6b7280;
        margin: 5px 0 0 0;
        font-size: 14px;
    }

    /* SUMMARY CARD */
    .summary-card {
        background: linear-gradient(135deg, #065f46 0%, #047857 100%);
        color: white;
        padding: 30px;
        border-radius: 16px;
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }

    .summary-card::after {
        content: "Rp";
        position: absolute;
        right: -10px;
        bottom: -20px;
        font-size: 120px;
        font-weight: 900;
        opacity: 0.1;
    }

    .summary-label {
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
        display: block;
        margin-bottom: 8px;
    }

    .summary-value {
        font-size: clamp(24px, 5vw, 36px);
        font-weight: 800;
        letter-spacing: -1px;
    }

    /* TABLE STYLING */
    .box {
        background: white;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
    }

    .table-responsive {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .report-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
        min-width: 800px;
    }

    .report-table th {
        background: #f9fafb;
        color: #374151;
        font-weight: 700;
        text-align: left;
        padding: 15px 20px;
        border-bottom: 2px solid #e5e7eb;
        text-transform: uppercase;
        font-size: 12px;
    }

    .report-table td {
        padding: 15px 20px;
        border-bottom: 1px solid #f3f4f6;
        color: #4b5563;
        vertical-align: middle;
    }

    .nominal-cell {
        font-weight: 700;
        color: #111827;
        text-align: right;
    }

    /* BUTTONS */
    .btn-action {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 18px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        transition: 0.2s;
        border: 1px solid transparent;
        cursor: pointer;
    }

    .btn-print { background: #0f172a; color: white; border: none; }
    .btn-back { background: white; color: #374151; border: 1px solid #d1d5db; }

    /* MOBILE & PRINT */
    @media (max-width: 640px) {
        .page-wrapper { padding: 15px; }
        .summary-card { flex-direction: column; align-items: flex-start; gap: 15px; }
    }

    @media print {
        .btn-action, .btn-back { display: none !important; }
        .page-wrapper { padding: 0; background: white; }
        .summary-card { background: white !important; color: black !important; border: 2px solid #000; box-shadow: none; }
        .summary-card::after { display: none; }
        .show-on-print { display: block !important; }
    }
</style>

<div class="page-wrapper">
    <div class="report-header">
        <div class="report-title">
            <h2>Laporan Pendapatan</h2>
            <p>PT. Kapuas Prima Niaga — Rekapitulasi Pembayaran Terverifikasi</p>
        </div>
        <div style="display: flex; gap: 10px;">
            <button onclick="window.print()" class="btn-action btn-print">🖨️ Cetak Laporan</button>
            <a href="{{ route('dashboard') }}" class="btn-action btn-back">← Dashboard</a>
        </div>
    </div>

    <div class="summary-card">
        <div>
            <span class="summary-label">Total Akumulasi Pendapatan</span>
            <div class="summary-value">Rp {{ number_format($total, 0, ',', '.') }}</div>
        </div>
        <div style="text-align: right; opacity: 0.9;">
            <div style="font-size: 14px; font-weight: 600;">Status Laporan:</div>
            <div style="font-size: 12px; background: rgba(255,255,255,0.2); padding: 4px 10px; border-radius: 4px; margin-top: 5px;">
                Aktual s/d {{ date('d/m/Y') }}
            </div>
        </div>
    </div>

    <div class="box">
        <div class="table-responsive">
            <table class="report-table">
                <thead>
                    <tr>
                        <th style="width: 70px;">No</th>
                        <th>Tanggal Bayar</th>
                        <th>Keterangan Transaksi</th>
                        <th>No. Referensi</th>
                        <th style="text-align: right;">Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $item)
                    <tr>
                        <td><span style="color: #94a3b8; font-weight: 600;">{{ $loop->iteration }}</span></td>
                        <td style="white-space: nowrap;">{{ \Carbon\Carbon::parse($item->tanggal_bayar)->format('d F Y') }}</td>
                        <td><strong style="color: #111827;">{{ $item->serahTerima->keterangan ?? 'Tanpa Keterangan' }}</strong></td>
                        <td><code style="font-size: 12px;">PAY-{{ $item->id }}</code></td>
                        <td class="nominal-cell">Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 60px; color: #94a3b8;">
                            Tidak ada data transaksi ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="show-on-print" style="display: none; margin-top: 50px;">
        <table style="width: 100%;">
            <tr>
                <td style="width: 70%;"></td>
                <td style="text-align: center;">
                    <p>Dicetak pada: {{ date('d/m/Y H:i') }}</p>
                    <br><br><br>
                    <p><strong>( ____________________ )</strong></p>
                    <p>Admin Keuangan</p>
                </td>
            </tr>
        </table>
    </div>
</div>
</x-app-layout>