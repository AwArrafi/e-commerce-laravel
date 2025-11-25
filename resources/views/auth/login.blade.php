@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto py-10">
        <h1 class="text-2xl font-bold mb-6 text-center">Login</h1>

        <form action="{{ route('login.post') }}" method="POST" class="bg-white shadow rounded-lg p-6 space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded px-3 py-2 text-sm"
                    required>
                @error('email')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Password</label>

                <div class="relative">
                    <input id="password" type="password" name="password" required
                        class="w-full border rounded-lg px-3 py-2 pr-11 focus:outline-none focus:ring-2 focus:ring-blue-200"
                        placeholder="Masukkan password">

                    <button type="button"
                        class="absolute inset-y-0 right-2 flex items-center px-2 text-slate-500 hover:text-slate-700"
                        data-toggle-password data-target="password" aria-label="Tampilkan password">
                        {{-- eye icon --}}
                        <svg data-eye class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>

                        {{-- eye-off icon --}}
                        <svg data-eye-off class="w-5 h-5 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M3 3l18 18" />
                            <path d="M10.58 10.58a3 3 0 004.24 4.24" />
                            <path d="M9.88 4.24A10.94 10.94 0 0112 5c6.5 0 10 7 10 7a17.4 17.4 0 01-3.2 4.4" />
                            <path d="M6.1 6.1C3.6 8 2 12 2 12s3.5 7 10 7a10.5 10.5 0 004.2-.9" />
                        </svg>
                    </button>
                </div>
            </div>


            <div class="flex items-center justify-between text-sm">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="remember" class="mr-2">
                    Remember me
                </label>
            </div>

            <button type="submit" class="w-full mt-2 px-4 py-2 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">
                Login
            </button>

            <p class="text-xs text-center text-gray-500 mt-3">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Daftar</a>
            </p>
        </form>
    </div>
@endsection
