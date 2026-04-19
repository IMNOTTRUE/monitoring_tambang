<x-app-layout>

<style>
        /* RESET & BASE */
    * {
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    /* BASE STYLING */
    .page-wrapper {
        padding: 30px;
        background-color: #f8f9fa;
        min-height: 100vh;
    }

    .report-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #e5e7eb;
    }

    .report-title h2 {
        font-size: 28px;
        font-weight: 800;
        color: #111827;
        margin: 0;
    }

    .report-title p {
        color: #6b7280;
        margin: 5px 0 0 0;
        font-size: 14px;
    }

    /* TOTAL SUMMARY BOX */
    .summary-card {
        background: #065f46; /* Deep Emerald */
        color: white;
        padding: 24px;
        border-radius: 12px;
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .summary-label {
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
        opacity: 0.9;
    }

    .summary-value {
        font-size: 32px;
        font-weight: 800;
        font-family: 'Courier New', Courier, monospace;
    }

    /* TABLE STYLING */
    .box {
        background: white;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }

    .report-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 15px;
    }

    .report-table th {
        background: #f9fafb;
        color: #374151;
        font-weight: 700;
        text-align: left;
        padding: 15px 20px;
        border-bottom: 1px solid #e5e7eb;
        text-transform: uppercase;
        font-size: 12px;
    }

    .report-table td {
        padding: 15px 20px;
        border-bottom: 1px solid #f3f4f6;
        color: #4b5563;
    }

    .report-table tr:last-child td {
        border-bottom: none;
    }

    /* ACCENTS */
    .nominal-cell {
        font-weight: 700;
        color: #111827;
        text-align: right;
        font-family: monospace;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        padding: 10px 20px;
        background: #ffffff;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        color: #374151;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: 0.2s;
    }

    .btn-back:hover {
        background: #f3f4f6;
    }

    /* PRINT OPTIMIZATION */
    @media print {
        .btn-back, .report-header .btn-print { display: none; }
        .page-wrapper { padding: 0; background: white; }
        .summary-card { border: 1px solid #000; color: black; background: white !important; box-shadow: none; }
        .summary-value { color: black !important; }
    }
</style>

<div class="page-wrapper">
    
    <div class="report-header">
        <div class="report-title">
            <h2>Laporan Pendapatan</h2>
            <p>Rekapitulasi seluruh pembayaran yang berhasil diverifikasi.</p>
        </div>
        <div style="display: flex; gap: 10px;">
            <button onclick="window.print()" class="btn-back" style="background: #0f766e; color: white; border: none;">
                🖨️ Cetak Laporan
            </button>
            <a href="{{ route('dashboard') }}" class="btn-back">← Dashboard</a>
        </div>
    </div>

    <div class="summary-card">
        <div>
            <span class="summary-label">Total Akumulasi Pendapatan</span>
            <div style="margin-top: 4px; font-size: 12px; opacity: 0.8;">Data berdasarkan transaksi lunas sampai hari ini.</div>
        </div>
        <div class="summary-value">
            Rp {{ number_format($total, 0, ',', '.') }}
        </div>
    </div>

    <div class="box">
        <table class="report-table">
            <thead>
                <tr>
                    <th style="width: 60px;">No</th>
                    <th>Tanggal Bayar</th>
                    <th>Keterangan Transaksi</th>
                    <th style="text-align: right;">Nominal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td style="white-space: nowrap;">
                        {{ \Carbon\Carbon::parse($item->tanggal_bayar)->format('d F Y') }}
                    </td>
                    <td>
                        <strong style="color: #111827;">{{ $item->serahTerima->keterangan ?? 'Tanpa Keterangan' }}</strong>
                        <div style="font-size: 11px; color: #9ca3af; margin-top: 2px;">Ref: PAY-{{ $item->id }}</div>
                    </td>
                    <td class="nominal-cell">
                        Rp {{ number_format($item->nominal, 0, ',', '.') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center; padding: 50px; color: #9ca3af;">
                        Tidak ada data transaksi ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</x-app-layout>