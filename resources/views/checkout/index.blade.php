@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Checkout</h1>

        <div class="grid md:grid-cols-2 gap-6">
            {{-- Form data pelanggan --}}
            <div class="bg-white rounded-lg shadow p-4">
                <h2 class="text-lg font-semibold mb-4">Data Pelanggan</h2>

                <form action="{{ route('checkout.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium mb-1">Nama Lengkap *</label>
                        <input type="text" name="customer_name" value="{{ old('customer_name') }}"
                            class="w-full border rounded px-3 py-2 text-sm" required>
                        @error('customer_name')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Email</label>
                        <input type="email" name="customer_email" value="{{ old('customer_email') }}"
                            class="w-full border rounded px-3 py-2 text-sm">
                        @error('customer_email')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">No. Telepon</label>
                        <input type="text" name="customer_phone" value="{{ old('customer_phone') }}"
                            class="w-full border rounded px-3 py-2 text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Alamat Lengkap</label>
                        <textarea name="customer_address" rows="3" class="w-full border rounded px-3 py-2 text-sm">{{ old('customer_address') }}</textarea>
                    </div>

                    <button type="submit" class="px-4 py-2 text-sm bg-green-600 text-white rounded hover:bg-green-700">
                        Proses Checkout
                    </button>
                </form>
            </div>

            {{-- Ringkasan Order --}}
            <div class="bg-white rounded-lg shadow p-4">
                <h2 class="text-lg font-semibold mb-4">Ringkasan Belanja</h2>

                <ul class="divide-y text-sm">
                    @foreach ($cart as $item)
                        <li class="py-2 flex justify-between">
                            <div>
                                <p class="font-medium">{{ $item['name'] }}</p>
                                <p class="text-xs text-gray-500">
                                    Qty: {{ $item['quantity'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="text-right">
                                Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                            </div>
                        </li>
                    @endforeach
                </ul>

                <div class="border-t mt-4 pt-3 flex justify-between items-center">
                    <span class="text-sm font-medium">Total</span>
                    <span class="text-lg font-bold">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection
