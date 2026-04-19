<x-app-layout>
<style>
    /* RESET & BASE */
    * {
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .dashboard {
        padding: 24px;
        background-color: #f8f9fa; /* Warna background abu-abu muda seperti di gambar */
        min-height: 100vh;
    }

    h2.page-title {
        font-size: 24px;
        font-weight: bold;
        color: #111827;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* GRID UTAMA - 2 Kolom */
    .dashboard-grid {
        display: grid;
        grid-template-columns: 1.6fr 1fr; /* Kolom kiri lebih lebar */
        gap: 20px;
    }

    /* LAYOUT KOLOM */
    .column-left, .column-right {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    /* CARD / BOX */
    .box {
        background: #ffffff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        border: 1px solid #e5e7eb;
    }

    .box-header {
        font-size: 16px;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #f3f4f6;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* KPI */
    .kpi-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
    }

    .kpi-item {
        border-right: 1px solid #e5e7eb;
        padding-right: 15px;
    }

    .kpi-item:last-child {
        border-right: none;
    }

    .kpi-item small {
        font-size: 13px;
        color: #6b7280;
        font-weight: 500;
    }

    .kpi-item h3 {
        font-size: 24px;
        font-weight: bold;
        color: #111827;
        margin-top: 5px;
    }

    /* CCTV GRID */
.cctv-wrapper {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
}

.cctv-card {
    background: #000;
    border-radius: 10px;
    overflow: hidden;
    position: relative;
}

.cctv-card iframe {
    width: 100%;
    height: 160px;
    border: none;
}

.cctv-info {
    position: absolute;
    top: 8px;
    left: 8px;
    background: rgba(0,0,0,0.6);
    color: white;
    font-size: 11px;
    padding: 4px 8px;
    border-radius: 6px;
}

.live-badge {
    position: absolute;
    bottom: 8px;
    left: 8px;
    background: rgba(0,0,0,0.6);
    color: #10b981;
    font-size: 11px;
    padding: 3px 8px;
    border-radius: 6px;
    font-weight: bold;
}
    /* MAP */
    .map-container img {
        width: 100%;
        height: auto;
        border-radius: 8px;
        background: #e0f2fe;
    }

    /* TABLES */
    .data-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    .data-table th, .data-table td {
        padding: 10px 8px;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
    }

    .data-table th {
        color: #6b7280;
        font-weight: 600;
        background: #f9fafb;
    }

    /* STATUS BADGES */
    .badge {
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: bold;
        color: white;
        text-align: center;
        display: inline-block;
    }
    .badge-green { background: #10b981; }
    .badge-yellow { background: #f59e0b; }
    .badge-red { background: #ef4444; }

    /* CHARTS */
    .chart-container {
        position: relative;
        height: 250px;
        width: 100%;
    }

    /* EXPORT SECTION */
    .export-section {
        display: flex;
        gap: 10px;
        align-items: center;
    }
    .btn-export {
        background: #0f766e;
        color: white;
        padding: 8px 15px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        font-weight: 600;
    }

    /* RESPONSIVE */
    @media (max-width: 1024px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }
        .cctv-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
<div id="notif-container"></div>
<div class="dashboard">

    <h2 class="page-title">Admin Dashboard - Sistem Management Tambang</h2>
    <div class="dashboard-grid">

        <div class="column-left">
            
            <div class="box">
                <div class="box-header">Real-time Monitoring & KPIs</div>
                <div class="kpi-container">
                    <div class="kpi-item">
                        <small>Total Pekerja Aktif</small>
                        <h3>{{ $total_pekerja }}</h3>
                    </div>
                    <div class="kpi-item">
                        <small>Uang Masuk (Bulan Ini)</small>
                        <h3>Rp {{ number_format($jogja + $gresik + $belitung, 0, ',', '.') }}</h3>
                    </div>
                    <div class="kpi-item">
                        <small>Rata-rata Proses</small>
                        <h3>7 Hari</h3>
                    </div>
                </div>
<div class="box">
    <div class="box-header">CCTV Live Feeds</div>

    <div class="cctv-wrapper">
        @foreach($cctvs as $item)
        @php
            $videoId = '';

            if (preg_match('/embed\/([^?]+)/', $item->url, $matches)) {
                $videoId = $matches[1];
            } elseif (preg_match('/v=([^&]+)/', $item->url, $matches)) {
                $videoId = $matches[1];
            }

            $embedUrl = $videoId 
                ? "https://www.youtube.com/embed/{$videoId}?autoplay=1&mute=1&loop=1&playlist={$videoId}"
                : null;
        @endphp

        <div class="cctv-card">

            @if($embedUrl)
                <iframe src="{{ $embedUrl }}"></iframe>
            @else
                <div style="height:160px; display:flex; align-items:center; justify-content:center; color:white;">
                    Video tidak valid
                </div>
            @endif

            <!-- LABEL -->
            <div class="cctv-info">
                {{ $item->nama }} - {{ $item->lokasi }}
            </div>

            <!-- LIVE -->
            <div class="live-badge">
                ● LIVE
            </div>

        </div>
        @endforeach
    </div>
</div>
                <div class="map-container">
                   <img src="{{ asset('storage/peta-monitoring.png') }}" 
         alt="Peta Nusantara Logistics" alt="Peta Lokasi" style="object-fit: cover; height: 250px;">
                </div>
            </div>

            <div class="box">
                <div class="box-header">Data Pekerja & Lokasi</div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div>
                    <table class="data-table">
                        <h3>{{ $total_pekerja }} Orang</h3>
                        <tr><th>Lokasi</th><th>Total Pegawai</th></tr>
                        <tr><td>Yogyakarta</td><td>{{ $pekerja_jogja }}</td></tr>
                        <tr><td>Belitung</td><td>{{ $pekerja_belitung }}</td></tr>
                        <tr><td>Gresik</td><td>{{ $pekerja_gresik }}</td></tr>
                    </table>
                    </div>
                    <div>
                    <table class="data-table">
                        <tr><th>Lokasi</th><th>Rekrutmen Terbaru</th></tr>

                        <tr>
                            <td>Yogyakarta</td>
                            <td>{{ $rek_jogja->jabatan ?? '-' }}</td>
                        </tr>

                        <tr>
                            <td>Belitung</td>
                            <td>{{ $rek_belitung->jabatan ?? '-' }}</td>
                        </tr>

                        <tr>
                            <td>Gresik</td>
                            <td>{{ $rek_gresik->jabatan ?? '-' }}</td>
                        </tr>
                    </table>
                    </div>
                </div>
            </div>

        </div>


        <div class="column-right">

            <div class="box">
                <div class="box-header">
                    <span>Data Operasional & Keuangan</span>
                    <select style="padding: 4px; border-radius: 4px; border:1px solid #ccc; font-size:12px;">
                        <option>Bulan Ini</option>
                    </select>
                </div>
                <div class="chart-container">
                    <canvas id="chartKeuangan"></canvas>
                </div>
            </div>

  <div class="box">
    <div class="box-header">Financial Overview (Per Lokasi)</div>
    <table class="data-table">
        <thead>
            <tr>
                <th>Lokasi</th>
                <th>Uang Masuk</th>
                <th>Uang Keluar</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Yogyakarta</strong></td>
                <td >Rp {{ number_format($masuk_jogja, 0, ',', '.') }}</td>
                <td >Rp {{ number_format($keluar_jogja, 0, ',', '.') }}</td>
                <td>
                    <span class="badge badge-{{ $status_jogja[1] }}">
                        {{ $status_jogja[0] }}
                    </span>
                </td>
            </tr>

            <tr>
                <td><strong>Belitung</strong></td>
                <td >Rp {{ number_format($masuk_belitung, 0, ',', '.') }}</td>
                <td >Rp {{ number_format($keluar_belitung, 0, ',', '.') }}</td>
                <td >
                    <span class="badge badge-{{ $status_belitung[1] }}">
                        {{ $status_belitung[0] }}
                    </span>
                </td>
            </tr>

            <tr>
                <td><strong>Gresik</strong></td>
                <td >Rp {{ number_format($masuk_gresik, 0, ',', '.') }}</td>
                <td >Rp {{ number_format($keluar_gresik, 0, ',', '.') }}</td>
                <td >
                    <span class="badge badge-{{ $status_gresik[1] }}">
                        {{ $status_gresik[0] }}
                    </span>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div class="box">
    <div class="box-header">Export Laporan</div>
    <form action="{{ route('dashboard.export') }}" method="GET" style="display: flex; gap: 10px; align-items: center;">
        <input type="date" name="tanggal" class="form-control" style="flex: 1; padding: 8px; border-radius: 6px; border: 1px solid #d1d5db;">
        <button type="submit" class="btn-export" style="white-space: nowrap; border: none; cursor: pointer;">
            ⬇ Export to Excel
        </button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const data = @json($grafik);

        // Fallback jika $grafik kosong agar chart tidak error
        const labels = data.length > 0 ? data.map(item => item.bulan) : ['Jan', 'Feb', 'Mar', 'Apr', 'Mei'];
        const masuk = data.length > 0 ? data.map(item => item.masuk) : [120, 150, 180, 140, 200];
        const keluar = data.length > 0 ? data.map(item => item.keluar) : [80, 110, 140, 100, 160];

        new Chart(document.getElementById('chartKeuangan'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    { 
                        label: 'Uang Masuk', 
                        data: masuk, 
                        backgroundColor: '#0f766e', /* Teal menyesuaikan tema */
                        borderRadius: 4
                    },
                    { 
                        label: 'Uang Keluar', 
                        data: keluar, 
                        backgroundColor: '#f59e0b', /* Kuning/Orange */
                        borderRadius: 4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
<script>
function loadNotif() {
    fetch('/notif-data')
        .then(res => res.json())
        .then(data => {
            let html = '';

            data.forEach(item => {
                html += `
                    <div style="padding:10px; border-bottom:1px solid #eee;">
                        ${!item.dibaca ? '<span style="color:red;">●</span>' : ''}
                        🔔 ${item.pesan}
                        <br>
                        <small style="color:gray;">
                            ${item.created_at}
                        </small>
                    </div>
                `;
            });

            document.getElementById('notif-container').innerHTML = html;
        });
}

// 🔥 reload tiap 5 detik
setInterval(loadNotif, 5000);
let lastCount = 0;

function loadNotif() {
    fetch('/notif-data')
    .then(res => res.json())
    .then(data => {

        if (data.length > lastCount) {
            new Audio('/notif.mp3').play();
        }

        lastCount = data.length;

        ...
    });
}
</script>
</x-app-layout>