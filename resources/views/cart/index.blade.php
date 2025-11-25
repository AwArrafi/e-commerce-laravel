@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Keranjang Belanja</h1>



        @if (empty($cart))
            <p>Keranjang masih kosong.</p>
            <a href="{{ route('products.index') }}" class="text-blue-600 hover:underline text-sm">
                &larr; Kembali ke daftar produk
            </a>
        @else
            <div class="bg-white rounded-lg shadow p-4">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-2">Produk</th>
                            <th class="text-right py-2">Harga</th>
                            <th class="text-center py-2">Qty</th>
                            <th class="text-right py-2">Subtotal</th>
                            <th class="text-center py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $item)
                            <tr class="border-b">
                                <td class="py-2">{{ $item['name'] }}</td>
                                <td class="py-2 text-right">
                                    Rp {{ number_format($item['price'], 0, ',', '.') }}
                                </td>
                                <td class="py-2 text-center">
                                    <form action="{{ route('cart.update', $item['product_id']) }}" method="POST"
                                        class="inline-flex items-center gap-2">
                                        @csrf
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                            class="w-16 border rounded px-2 py-1 text-center text-sm">
                                        <button type="submit"
                                            class="px-3 py-1 text-xs bg-gray-200 rounded hover:bg-gray-300">
                                            Update
                                        </button>
                                    </form>
                                </td>
                                <td class="py-2 text-right">
                                    Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                                </td>
                                <td class="py-2 text-center">
                                    <form action="{{ route('cart.remove', $item['product_id']) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="px-3 py-1 text-xs bg-red-500 text-white rounded hover:bg-red-600">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4 flex justify-between items-center">
                    <a href="{{ route('products.index') }}" class="text-sm text-blue-600 hover:underline">
                        &larr; Tambah produk lain
                    </a>

                    <div class="text-right">
                        <p class="text-sm text-gray-600">Total:</p>
                        <p class="text-xl font-bold">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </p>

                        <a href="{{ route('checkout.index') }}"
                            class="mt-3 inline-block px-4 py-2 text-sm bg-green-600 text-white rounded hover:bg-green-700">
                            Checkout
                        </a>

                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
