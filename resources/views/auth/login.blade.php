<x-guest-layout>
    <style>
        .login-card {
            background: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h2 {
            color: #0f172a;
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 8px;
        }

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
            outline: none;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .btn-login {
            width: 100%;
            background: #0f172a;
            color: white;
            padding: 14px;
            border-radius: 10px;
            font-weight: 700;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 20px;
        }

        .btn-login:hover {
            background: #1e293b;
        }

        /* Style untuk area Register */
        .register-section {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #f1f5f9;
            text-align: center;
        }

        .btn-outline-register {
            display: inline-block;
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border: 2px solid #0f172a;
            color: #0f172a;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s;
        }

        .btn-outline-register:hover {
            background: #0f172a;
            color: white;
        }
    </style>

    <div class="login-card">
        <div class="login-header">
            <h2>PT. Kapuas Prima Niaga</h2>
            <p style="color: #64748b; font-size: 14px;">Sistem Management Tambang</p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700">Alamat Email</label>
                <input id="email" class="custom-input" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-5">
                <div class="flex justify-between items-center">
                    <label class="block text-sm font-semibold text-gray-700">Kata Sandi</label>
                    @if (Route::has('password.request'))
                        <a class="text-xs text-blue-600 hover:underline" href="{{ route('password.request') }}">Lupa sandi?</a>
                    @endif
                </div>
                <input id="password" class="custom-input" type="password" name="password" required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <button type="submit" class="btn-login">Masuk Sekarang</button>
        </form>

        <div class="register-section">
            <p style="font-size: 13px; color: #64748b;">Belum memiliki akun?</p>
            <a href="{{ route('register') }}" class="btn-outline-register">
                Daftar Akun Baru
            </a>
        </div>
    </div>
</x-guest-layout>