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
                <input type="password" name="password" class="w-full border rounded px-3 py-2 text-sm" required>
                @error('password')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
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
