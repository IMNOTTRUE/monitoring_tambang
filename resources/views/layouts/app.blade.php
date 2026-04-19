<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/ico" href="{{ asset('storage/logo.ico') }}">
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT. Kapuas Prima Niaga - Management System</title>
    @vite(['resources/js/app.js'])
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <audio id="notif-sound">
    <source src="{{ asset('storage/notif.mp3') }}" type="audio/mpeg">
</audio>
<div id="notif-toast" style="
    position:fixed;
    bottom:20px;  /* 🔥 pindah ke bawah */
    right:20px;
    z-index:9999;
"></div>
    <style>
        /* RESET & BASE */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }

        body {
            background: #f4f6f9;
            display: flex;
            overflow-x: hidden; /* Mencegah scroll horizontal */
        }

        /* OVERLAY (Background gelap saat sidebar terbuka di mobile) */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 90;
            transition: opacity 0.3s;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            min-width: 250px;
            height: 100vh;
            background: #0f172a;
            color: white;
            position: fixed;
            padding: 24px 16px;
            z-index: 100;
            transition: transform 0.3s ease; /* Animasi saat buka/tutup */
        }

        .sidebar h4 {
            font-size: 1.2rem;
            margin-bottom: 30px;
            padding-left: 10px;
            color: #38bdf8;
            font-weight: 800;
        }

        /* MENU */
        .menu a {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: #94a3b8;
            text-decoration: none;
            border-radius: 10px;
            margin-bottom: 4px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .menu a:hover {
            background: #1e293b;
            color: white;
        }

        .menu a.active {
            background: #2563eb;
            color: white !important;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        /* MAIN WRAPPER */
        .main-wrapper {
            flex-grow: 1;
            margin-left: 250px; 
            display: flex;
            flex-direction: column;
            min-width: 0; 
            transition: margin-left 0.3s ease; /* Animasi transisi margin */
        }

        /* TOPBAR */
        .topbar {
            height: 64px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 80;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        /* TOMBOL TOGGLE MOBILE */
        .mobile-toggle {
            display: none; /* Sembunyikan secara default di desktop */
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            color: #334155;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: 0.2s;
        }

        .mobile-toggle:hover {
            background: #e2e8f0;
        }

        /* DROPDOWN LOGOUT */
        .user-menu {
            position: relative;
        }

        .dropdown-btn {
            background: none;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
            color: #334155;
            padding: 8px 12px;
            border-radius: 8px;
            transition: background 0.2s;
        }

        .dropdown-btn:hover { background: #f1f5f9; }

        .dropdown-content {
            position: absolute;
            right: 0;
            top: 110%;
            width: 180px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .dropdown-content form button {
            width: 100%;
            text-align: left;
            padding: 12px 16px;
            border: none;
            background: none;
            color: #dc2626;
            cursor: pointer;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .dropdown-content form button:hover { background: #fef2f2; }

        /* CONTENT */
        .content {
            padding: 30px;
        }

        /* =========================================
           RESPONSIVE DESIGN (MOBILE & TABLET)
           ========================================= */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%); /* Geser sidebar keluar layar */
            }

            .sidebar.active {
                transform: translateX(0); /* Tarik kembali ke dalam layar saat diklik */
            }

            .main-wrapper {
                margin-left: 0; /* Area konten memakan layar penuh */
            }

            .topbar {
                padding: 0 15px; /* Sesuaikan padding agar pas di HP */
            }

            .mobile-toggle {
                display: block; /* Munculkan tombol panah */
            }

            .sidebar-overlay.active {
                display: block; /* Munculkan layar hitam transparant */
            }

            .content {
                padding: 15px; /* Kurangi padding konten di HP */
            }
        }
    </style>
</head>
<body>
    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

    <aside class="sidebar">
        <h4>PT. Kapuas Prima Niaga</h4>

 <nav class="menu">

    {{-- DASHBOARD --}}
    @auth
        @if(auth()->user()->role == 'admin')
            <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
                🏠 Dashboard
            </a>
        @else
            <a href="{{ route('user.dashboard') }}" class="{{ request()->is('user-dashboard') ? 'active' : '' }}">
                🏠 Dashboard
            </a>
        @endif
    @endauth

    {{-- MENU UMUM (ADMIN + USER) --}}
    <a href="{{ route('pengiriman.index') }}" class="{{ request()->routeIs('pengiriman.*') ? 'active' : '' }}">📦 Pengiriman</a>
    <a href="{{ route('penerimaan.index') }}" class="{{ request()->routeIs('penerimaan.*') ? 'active' : '' }}">📥 Penerimaan</a>
    <a href="{{ route('pengeringan.index') }}" class="{{ request()->routeIs('pengeringan.*') ? 'active' : '' }}">🔥 Pengeringan</a>
    <a href="{{ route('serah-terima.index') }}" class="{{ request()->routeIs('serah-terima.*') ? 'active' : '' }}">📄 Serah Terima</a>


    {{-- KHUSUS ADMIN --}}
    @if(auth()->user()->role == 'admin')

{{-- PEMBAYARAN DROPDOWN --}}
<div x-data="{ open: {{ request()->is('operasional*') || request()->is('gaji*') ? 'true' : 'false' }} }">

    <!-- tombol utama -->
    <a href="#" @click.prevent="open = !open"
        style="justify-content: space-between;">
        <span>💰 Pembayaran</span>
        <span x-text="open ? '▲' : '▼'"></span>
    </a>

    <!-- isi dropdown -->
    <div x-show="open" x-transition x-cloak style="margin-left:15px;">

        <a href="{{ route('operasional.index') }}"
           class="{{ request()->routeIs('operasional.*') ? 'active' : '' }}">
            - Operasional
        </a>

        <a href="{{ route('gaji.index') }}"
           class="{{ request()->routeIs('gaji.*') ? 'active' : '' }}">
            - Gaji Karyawan
        </a>

    </div>

</div>
        <a href="{{ route('kas.index') }}" class="{{ request()->routeIs('kas.*') ? 'active' : '' }}">💳 Kas</a>
        <a href="{{ route('pekerja.index') }}" class="{{ request()->routeIs('pekerja.*') ? 'active' : '' }}">👷 Pekerja</a>
        <a href="{{ route('laporan.index') }}" class="{{ request()->routeIs('laporan.*') ? 'active' : '' }}">📊 Laporan</a>
        <a href="{{ route('cctv.index') }}" class="{{ request()->routeIs('cctv.*') ? 'active' : '' }}">📹 CCTV</a>
    @endif

</nav>
    </aside>

    <div class="main-wrapper">
        <header class="topbar">
            
            <div class="topbar-left">
                <button class="mobile-toggle" onclick="toggleSidebar()" id="toggleBtn">
                    <span id="arrowIcon">▶</span>
                </button>
                
                <h5 style="color: #64748b; font-weight: 500;">
                    {{ ucfirst(request()->path()) }} 
                </h5>
            </div>

          <div style="display:flex; align-items:center; gap:15px;">

    <!-- 🔔 NOTIF -->
    <div style="position:relative;">

        <div id="notif-bell" style="cursor:pointer; font-size:20px;">
            🔔
            <span id="notif-count" style="
                position:absolute;
                top:-5px;
                right:-5px;
                background:red;
                color:white;
                font-size:11px;
                padding:2px 6px;
                border-radius:50%;
                display:none;
            ">0</span>
        </div>

        <!-- DROPDOWN -->
        <div id="notif-dropdown" style="
            display:none;
            position:absolute;
            right:0;
            top:35px;
            width:320px;
            background:white;
            border-radius:12px;
            box-shadow:0 10px 30px rgba(0,0,0,0.15);
            max-height:300px;
            overflow:auto;
            z-index:999;
        ">
            <div style="padding:12px; font-weight:bold; border-bottom:1px solid #eee;">
                🔔 Notifikasi
            </div>

            <div id="notif-list">
    @foreach($notifs as $notif)
        <div style="padding:10px; border-bottom:1px solid #eee;">
            <div>
                @if(!$notif->dibaca)
                    🔴
                @endif
                🔔 {{ $notif->pesan }}
            </div>

            <small style="color:#94a3b8;">
                {{ $notif->created_at->diffForHumans() }}
            </small>

            @if(!$notif->dibaca)
                <form method="POST" action="{{ route('notif.baca', $notif->id) }}">
                    @csrf
                    <button style="font-size:12px; color:blue;">
                        Tandai dibaca
                    </button>
                </form>
            @endif
        </div>
    @endforeach
</div>
        </div>

    </div>

    <!-- USER -->
    <div class="user-menu" x-data="{ open: false }">
        <button @click="open = !open" @click.away="open = false" class="dropdown-btn">
            <span>{{ auth()->user()->name ?? 'Admin' }}</span>
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 14px;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <div x-show="open" x-cloak class="dropdown-content">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">🚪 Logout</button>
            </form>
        </div>
    </div>

</div>
        </header>

        <main class="content">
            {{ $slot }}
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            const arrow = document.getElementById('arrowIcon');
            
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');

            // Ubah arah panah berdasarkan status sidebar
            if (sidebar.classList.contains('active')) {
                arrow.innerText = '◀';
            } else {
                arrow.innerText = '▶';
            }
        }

        // Tutup otomatis jika user memperbesar ukuran layar ke mode desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                document.querySelector('.sidebar').classList.remove('active');
                document.querySelector('.sidebar-overlay').classList.remove('active');
                document.getElementById('arrowIcon').innerText = '▶';
            }
        });
        let notifCount = 0;

document.addEventListener('DOMContentLoaded', function () {

    let notifCount = 0;

    console.log('DOM READY 🔥');

    // 🔔 ELEMENT
    let bell = document.getElementById('notif-bell');
    let badge = document.getElementById('notif-count');
    let dropdown = document.getElementById('notif-dropdown');
    let list = document.getElementById('notif-list');

    console.log('CEK ELEMENT:', bell, badge, dropdown);

    // 🔔 CLICK EVENT (FIX)
    if (bell) {
        bell.addEventListener('click', () => {
            dropdown.style.display =
                dropdown.style.display === 'block' ? 'none' : 'block';

            notifCount = 0;
            badge.style.display = 'none';
        });
    }

    // 🔥 REALTIME LISTENER
    window.Echo.channel('notif-channel')
        .listen('.notif-event', (e) => {

            console.log('EVENT MASUK 🔥:', e);

            // 🔴 BADGE
            notifCount++;
            badge.innerText = notifCount;
            badge.style.display = 'inline-block';

            // 📜 LIST
            if (list) {
                let item = document.createElement('div');
                item.innerHTML = `🔔 ${e.pesan}`;
                item.style.padding = '10px';
                item.style.borderBottom = '1px solid #eee';

                list.prepend(item);
            }

            // 🔊 SUARA
            let sound = document.getElementById('notif-sound');
            if (sound) sound.play();

            // 📢 TOAST
            let toast = document.getElementById('notif-toast');

            let notif = document.createElement('div');
            notif.innerHTML = `🔔 ${e.pesan}`;
            notif.style.background = '#1e293b';
            notif.style.color = 'white';
            notif.style.padding = '12px';
            notif.style.marginBottom = '10px';
            notif.style.borderRadius = '8px';

            toast.appendChild(notif);

            setTimeout(() => notif.remove(), 5000);
        });

});
    </script>
</body>
</html>