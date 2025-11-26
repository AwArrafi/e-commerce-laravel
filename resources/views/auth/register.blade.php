@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto py-10">
        <h1 class="text-2xl font-bold mb-6 text-center">Register</h1>

        <form action="{{ route('register.post') }}" method="POST" class="bg-white shadow rounded-lg p-6 space-y-4"
            autocomplete="off">
            @csrf

            {{-- Dummy fields (anti autofill ngawur) --}}
            <input type="text" name="fake_user" autocomplete="username" class="hidden" aria-hidden="true">
            <input type="password" name="fake_pass" autocomplete="new-password" class="hidden" aria-hidden="true">

            <div>
                <label class="block text-sm font-medium mb-1">Nama</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full border rounded px-3 py-2 text-sm" required autocomplete="off" spellcheck="false"
                    placeholder="Nama">
                @error('name')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full border rounded px-3 py-2 text-sm" required autocomplete="username" spellcheck="false"
                    placeholder="Email">
                @error('email')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Password</label>
                <div class="relative">
                    <input id="reg_password" type="password" name="password" required autocomplete="new-password"
                        class="w-full border rounded-lg px-3 py-2 pr-12 focus:outline-none focus:ring-2 focus:ring-blue-200"
                        placeholder="Password">

                    <button type="button" onclick="togglePassword('reg_password', this)"
                        class="absolute right-2 top-1/2 -translate-y-1/2 z-50
                               inline-flex items-center justify-center
                               w-9 h-9 rounded-md
                               text-slate-500 hover:text-slate-700 hover:bg-slate-100"
                        aria-label="Tampilkan password">
                        <svg data-eye class="w-5 h-5 block" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>

                        <svg data-eye-off class="w-5 h-5 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M3 3l18 18" />
                            <path d="M10.58 10.58a3 3 0 004.24 4.24" />
                            <path d="M9.88 4.24A10.94 10.94 0 0112 5c6.5 0 10 7 10 7a17.4 0 01-3.2 4.4" />
                            <path d="M6.1 6.1C3.6 8 2 12 2 12s3.5 7 10 7a10.5 10.5 0 004.2-.9" />
                        </svg>
                    </button>
                </div>

                @error('password')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Konfirmasi Password</label>
                <div class="relative">
                    <input id="reg_password_confirmation" type="password" name="password_confirmation" required
                        autocomplete="new-password"
                        class="w-full border rounded-lg px-3 py-2 pr-12 focus:outline-none focus:ring-2 focus:ring-blue-200"
                        placeholder="Konfirmasi Password">

                    <button type="button" onclick="togglePassword('reg_password_confirmation', this)"
                        class="absolute right-2 top-1/2 -translate-y-1/2 z-50
                               inline-flex items-center justify-center
                               w-9 h-9 rounded-md
                               text-slate-500 hover:text-slate-700 hover:bg-slate-100"
                        aria-label="Tampilkan password">
                        <svg data-eye class="w-5 h-5 block" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>

                        <svg data-eye-off class="w-5 h-5 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M3 3l18 18" />
                            <path d="M10.58 10.58a3 3 0 004.24 4.24" />
                            <path d="M9.88 4.24A10.94 10.94 0 0112 5c6.5 0 10 7 10 7a17.4 0 01-3.2 4.4" />
                            <path d="M6.1 6.1C3.6 8 2 12 2 12s3.5 7 10 7a10.5 10.5 0 004.2-.9" />
                        </svg>
                    </button>
                </div>
            </div>

            <button type="submit" class="w-full mt-2 px-4 py-2 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">
                Daftar
            </button>

            <p class="text-xs text-center text-gray-500 mt-3">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
            </p>
        </form>
    </div>

    <script>
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            if (!input) return;

            const show = input.type === 'password';
            input.type = show ? 'text' : 'password';

            const eye = btn.querySelector('[data-eye]');
            const eyeOff = btn.querySelector('[data-eye-off]');
            if (eye && eyeOff) {
                eye.classList.toggle('hidden', show);
                eyeOff.classList.toggle('hidden', !show);
            }

            btn.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
        }
    </script>
@endsection
