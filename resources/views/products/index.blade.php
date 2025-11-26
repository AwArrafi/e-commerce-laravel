@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Daftar Produk</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse ($products as $product)
                <div class="border rounded-lg shadow-sm bg-white flex flex-col overflow-hidden">
                    {{-- Gambar produk --}}
                    @if ($product->image_path)
                        <img src="{{ $product->image_path }}" alt="{{ $product->name }}" class="w-full h-80 object-cover">
                    @else
                        <div class="w-full h-40 bg-gray-200 flex items-center justify-center text-xs text-gray-500">
                            Tidak ada gambar
                        </div>
                    @endif


                    {{-- Isi card --}}
                    <div class="p-4 flex flex-col flex-1">
                        <div class="mb-3">
                            <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
                            <p class="text-sm text-gray-600 mt-1">
                                {{ Str::limit($product->description, 80) }}
                            </p>
                        </div>

                        <div class="mt-auto">
                            <p class="text-lg font-bold mb-2">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                            {{-- <p class="text-xs text-gray-500 mb-3">
                                Stok: {{ $product->stock }}
                            </p> --}}

                            @if ($product->stock > 0)
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium
                       bg-blue-600 text-white rounded hover:bg-blue-700">
                                        Tambah ke Keranjang
                                    </button>
                                </form>
                            @else
                                <button type="button"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium
                   bg-gray-400 text-white rounded cursor-not-allowed"
                                    disabled>
                                    Stok Habis
                                </button>
                            @endif
                        </div>

                    </div>
                </div>
            @empty
                <p>Tidak ada produk.</p>
            @endforelse
        </div>
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    </div>
@endsection
