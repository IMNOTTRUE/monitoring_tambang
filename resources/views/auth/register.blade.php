<x-guest-layout>
    <style>
        /* Desain card register agar konsisten dengan login */
        .register-card {
            background: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
        }

        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .register-header h2 {
            color: #0f172a; /* Warna sidebar dashboard */
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .register-header p {
            color: #64748b;
            font-size: 14px;
        }

        /* Styling Input */
        .custom-input {
            width: 100%;
            padding: 12px 16px;
            border-radius: 10px;
            border: 1px solid #d1d5db;
            transition: all 0.2s;
            margin-top: 6px;
            display: block;
        }

        .custom-input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            outline: none;
        }

        /* Tombol Register */
        .btn-register {
            width: 100%;
            background: #0f172a; /* Senada dengan sidebar dashboard */
            color: white;
            padding: 14px;
            border-radius: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 25px;
        }

        .btn-register:hover {
            background: #1e293b;
        }

        .login-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
            color: #64748b;
            text-decoration: none;
        }

        .login-link:hover {
            color: #2563eb;
            text-decoration: underline;
        }
    </style>

    <div class="register-card">
        <div class="register-header">
            <h2>Daftar Akun Baru</h2>
            <p>PT. Kapuas Prima Niaga - Sistem Management Tambang</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700">Nama Lengkap</label>
                <input id="name" class="custom-input" type="text" name="name" :value="old('name')" required autofocus placeholder="Masukkan nama lengkap..." />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <label for="email" class="block text-sm font-semibold text-gray-700">Alamat Email</label>
                <input id="email" class="custom-input" type="email" name="email" :value="old('email')" required placeholder="email@contoh.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <label for="password" class="block text-sm font-semibold text-gray-700">Kata Sandi</label>
                <input id="password" class="custom-input" type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-4">
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Konfirmasi Kata Sandi</label>
                <input id="password_confirmation" class="custom-input" type="password" name="password_confirmation" required placeholder="Ulangi kata sandi" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <button type="submit" class="btn-register">
                Daftar Sekarang
            </button>

            <a class="login-link" href="{{ route('login') }}">
                Sudah punya akun? Silakan masuk
            </a>
        </form>
    </div>
</x-guest-layout>