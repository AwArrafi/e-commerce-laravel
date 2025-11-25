@extends('admin.layouts.app', ['title' => 'Edit Produk'])

@section('content')
    <div class="mb-4">
        <h1 class="text-xl font-bold">Edit Produk</h1>
        <p class="text-sm text-slate-500">Perbarui data produk.</p>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="p-3 rounded-lg bg-red-50 text-red-700 text-sm">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div>
                <label class="text-sm font-medium">Nama Produk</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}"
                    class="mt-1 w-full px-3 py-2 rounded-lg border border-slate-200">
            </div>

            <div>
                <label class="text-sm font-medium">Deskripsi</label>
                <textarea name="description" rows="4" class="mt-1 w-full px-3 py-2 rounded-lg border border-slate-200">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-medium">Harga</label>
                    <input type="number" name="price" min="0" value="{{ old('price', $product->price) }}"
                        class="mt-1 w-full px-3 py-2 rounded-lg border border-slate-200">
                </div>

                <div>
                    <label class="text-sm font-medium">Stok</label>
                    <input type="number" name="stock" min="0" value="{{ old('stock', $product->stock) }}"
                        class="mt-1 w-full px-3 py-2 rounded-lg border border-slate-200">
                </div>
            </div>

            <div>
                <label class="text-sm font-medium">Image URL (optional)</label>
                <input type="text" name="image_path" value="{{ old('image_path', $product->image_path) }}"
                    class="mt-1 w-full px-3 py-2 rounded-lg border border-slate-200">
                @if ($product->image_path)
                    <div
                        class="mt-2 w-full h-48 rounded-lg border border-slate-200 bg-white flex items-center justify-center overflow-hidden">
                        <img src="{{ $product->image_path }}" class="max-w-full max-h-full object-contain" alt="preview">
                    </div>
                @endif
            </div>

            <div class="flex items-center justify-between pt-2">
                <a href="{{ route('admin.products.index') }}" class="text-sm text-slate-600 hover:underline">
                    ← Kembali
                </a>

                <button class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 text-sm font-medium">
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection
