<x-app-layout>

<style>
        /* RESET & BASE */
    * {
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    /* BASE STYLING */
    .page-wrapper {
        padding: 24px;
        background-color: #f8f9fa;
        min-height: 100vh;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .page-title {
        font-size: 24px;
        font-weight: bold;
        color: #111827;
        margin: 0;
    }

    /* TOOLBAR (FILTER & ADD) */
    .toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        gap: 15px;
    }

    .filter-select {
        width: 220px;
        padding: 8px 12px;
        border-radius: 8px;
        border: 1px solid #d1d5db;
        font-size: 14px;
        outline: none;
    }

    .btn-add {
        background: #0f766e;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: 0.2s;
    }

    .btn-add:hover { background: #0d5f59; }

    /* CARD CONTAINER */
    .box {
        background: white;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        border: 1px solid #e5e7eb;
        overflow: hidden;
    }

    /* TABLE STYLING */
    .data-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    .data-table th {
        background: #f9fafb;
        color: #6b7280;
        font-weight: 600;
        text-align: left;
        padding: 12px 15px;
        border-bottom: 1px solid #e5e7eb;
        text-transform: uppercase;
        font-size: 12px;
    }

    .data-table td {
        padding: 15px;
        border-bottom: 1px solid #f3f4f6;
        vertical-align: middle;
        color: #374151;
    }

    /* WORKER AVATAR (Initial) */
    .avatar {
        width: 35px;
        height: 35px;
        background: #e5e7eb;
        color: #4b5563;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-weight: bold;
        font-size: 14px;
        margin-right: 12px;
    }

    .worker-name-cell {
        display: flex;
        align-items: center;
    }

    /* TAGS */
    .badge-lokasi {
        background: #f3f4f6;
        color: #4b5563;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
    }

    /* ACTIONS */
    .btn-edit { color: #f59e0b; text-decoration: none; font-weight: 600; margin-right: 15px; }
    .btn-delete { color: #ef4444; background: none; border: none; font-weight: 600; cursor: pointer; padding: 0; }

    @media (max-width: 768px) {
        .toolbar { flex-direction: column; align-items: flex-start; }
        .filter-select { width: 100%; }
    }
</style>

<div class="page-wrapper">
    
    <div class="page-header">
        <h2 class="page-title">Manajemen Pekerja</h2>
    </div>

    @if(session('success'))
        <div style="background: #d1fae5; color: #065f46; padding: 12px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #a7f3d0; font-size: 14px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="toolbar">
        <form method="GET">
            <select name="lokasi" onchange="this.form.submit()" class="filter-select">
                <option value="">📍 Semua Lokasi</option>
                <option value="Jogja" {{ request('lokasi') == 'Jogja' ? 'selected' : '' }}>Jogja</option>
                <option value="Gresik" {{ request('lokasi') == 'Gresik' ? 'selected' : '' }}>Gresik</option>
                <option value="Belitung" {{ request('lokasi') == 'Belitung' ? 'selected' : '' }}>Belitung</option>
            </select>
        </form>

        <a href="{{ route('pekerja.create') }}" class="btn-add">
            + Tambah Pekerja Baru
        </a>
    </div>

    <div class="box">
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Nama Lengkap</th>
                    <th>Jabatan</th>
                    <th>No. HP</th>
                    <th>Alamat</th>
                    <th>Lokasi</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <div class="worker-name-cell">
                            <div class="avatar">{{ substr($item->nama, 0, 1) }}</div>
                            <div>
                                <div style="font-weight: 700; color: #111827;">{{ $item->nama }}</div>
                                <div style="font-size: 12px; color: #6b7280;">ID: WRK-{{ 100 + $item->id }}</div>
                            </div>
                        </div>
                    </td>
                    <td style="font-weight: 500;">{{ $item->jabatan }}</td>
                    <td>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->no_hp) }}" target="_blank" style="text-decoration: none; color: #0f766e;">
                            {{ $item->no_hp }} 📲
                        </a>
                    </td>
                    <td title="{{ $item->alamat }}">
                        <span style="font-size: 13px;">{{ Str::limit($item->alamat, 25) }}</span>
                    </td>
                    <td>
                        <span class="badge-lokasi">{{ $item->lokasi }}</span>
                    </td>
                    <td style="text-align: center;">
                        <a href="{{ route('pekerja.edit', $item->id) }}" class="btn-edit">Edit</a>
                        
                        <form action="{{ route('pekerja.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus data pekerja ini?')" class="btn-delete">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 40px; color: #9ca3af;">Data pekerja tidak ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

</x-app-layout>