<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Admin' }} - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 text-slate-900">
    <div class="min-h-screen flex">

        {{-- Sidebar --}}
        <aside class="w-64 hidden md:flex flex-col bg-white border-r border-slate-200">
            <div class="px-6 py-5 border-b border-slate-200">
                <div class="text-lg font-bold tracking-tight">Admin Panel</div>
                <div class="text-xs text-slate-500">{{ config('app.name') }}</div>
            </div>

            <nav class="p-4 space-y-1">
                <a href="{{ route('admin.products.index') }}"
                    class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm
               {{ request()->routeIs('admin.products.*') ? 'bg-blue-50 text-blue-700' : 'hover:bg-slate-100 text-slate-700' }}">
                    <span
                        class="inline-block w-2 h-2 rounded-full {{ request()->routeIs('admin.products.*') ? 'bg-blue-600' : 'bg-slate-300' }}"></span>
                    Produk
                </a>

                {{-- kalau nanti mau tambah: orders/users dashboard --}}
                {{-- <a href="#" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm hover:bg-slate-100 text-slate-700">Dashboard</a> --}}
            </nav>

            <div class="mt-auto p-4 border-t border-slate-200">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full inline-flex justify-center items-center px-3 py-2 rounded-lg text-sm
                               bg-red-600 text-white hover:bg-red-700">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main --}}
        <main class="flex-1">
            {{-- Topbar --}}
            <header class="bg-white border-b border-slate-200">
                <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="md:hidden text-sm font-semibold">Admin</div>
                        <div class="hidden md:block">
                            <div class="text-sm font-semibold">{{ $title ?? 'Admin' }}</div>
                            <div class="text-xs text-slate-500">Kelola produk & stok</div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="text-right">
                            <div class="text-sm font-semibold">{{ auth()->user()->name ?? 'Admin' }}</div>
                            <div class="text-xs text-slate-500">{{ auth()->user()->email ?? '' }}</div>
                        </div>
                        <div
                            class="w-9 h-9 rounded-full bg-slate-200 flex items-center justify-center text-sm font-bold">
                            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                        </div>
                    </div>
                </div>
            </header>

            {{-- Content --}}
            <div class="max-w-6xl mx-auto p-4">
                {{-- Toast (pakai yang kamu sudah bikin) --}}
                @php
                    $t = session('toast');
                    $type = $t['type'] ?? null;
                    $message = $t['message'] ?? null;

                    $classes = match ($type) {
                        'success' => 'bg-green-600 text-white',
                        'danger', 'error' => 'bg-red-600 text-white',
                        'warning' => 'bg-yellow-500 text-black',
                        default => 'bg-slate-900 text-white',
                    };
                @endphp

                @if ($message)
                    <div id="toast" class="fixed top-4 right-4 z-50">
                        <div class="px-4 py-2 rounded-lg shadow {{ $classes }}">
                            <span class="text-sm">{{ $message }}</span>
                        </div>
                    </div>
                    <script>
                        setTimeout(() => {
                            const t = document.getElementById('toast');
                            if (!t) return;
                            t.style.opacity = '0';
                            t.style.transition = 'opacity 0.5s';
                            setTimeout(() => t.remove(), 500);
                        }, 2500);
                    </script>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>

</html>
