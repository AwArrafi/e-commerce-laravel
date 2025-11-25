<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">


    {{-- Navbar --}}
    <nav class="bg-white shadow mb-6">
        <div class="max-w-6xl mx-auto px-4 py-3 flex justify-between items-center">
            <a href="{{ url('/products') }}" class="text-lg font-semibold">
                E-Commerce
            </a>

            @php
                $cart = session('cart', []);
                $cartCount = is_array($cart) ? array_sum(array_column($cart, 'quantity')) : 0;
            @endphp


            <div class="space-x-4 text-sm">
                <a href="{{ route('products.index') }}" class="hover:underline">Produk</a>

                @auth
                    <a href="{{ route('cart.index') }}" class="relative hover:underline inline-flex items-center gap-1">
                        <span>Keranjang</span>
                        @if ($cartCount > 0)
                            <span
                                class="inline-flex items-center justify-center text-xs font-semibold
                             rounded-full bg-red-500 text-white min-w-[18px] h-[18px] px-1">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>



                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="hover:underline">
                            Logout ({{ auth()->user()->name }})
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:underline">Login</a>
                    <a href="{{ route('register') }}" class="hover:underline">Register</a>
                @endauth
            </div>

        </div>
    </nav>

    {{-- TOAST FLASH MESSAGE --}}
    @php
        $toast = session('toast');
        $type = $toast['type'] ?? null;
        $message = $toast['message'] ?? null;

        $classes = match ($type) {
            'success' => 'bg-green-600 text-white',
            'danger' => 'bg-red-600 text-white',
            'error' => 'bg-red-600 text-white',
            'warning' => 'bg-yellow-500 text-black',
            default => 'bg-gray-800 text-white',
        };
    @endphp

    @if ($message)
        <div id="toast" class="fixed top-4 right-4 z-50">
            <div class="px-4 py-2 rounded shadow {{ $classes }}">
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


    <main>
        @yield('content')
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('[data-toggle-password]').forEach((btn) => {
                btn.addEventListener('click', () => {
                    const targetId = btn.getAttribute('data-target');
                    const input = document.getElementById(targetId);
                    if (!input) return;

                    const isHidden = input.type === 'password';
                    input.type = isHidden ? 'text' : 'password';

                    const eye = btn.querySelector('[data-eye]');
                    const eyeOff = btn.querySelector('[data-eye-off]');
                    if (eye && eyeOff) {
                        eye.classList.toggle('hidden', isHidden);
                        eyeOff.classList.toggle('hidden', !isHidden);
                    }

                    btn.setAttribute('aria-label', isHidden ? 'Sembunyikan password' :
                        'Tampilkan password');
                });
            });
        });
    </script>


</body>

</html>
