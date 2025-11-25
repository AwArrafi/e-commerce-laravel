@extends('admin.layouts.app', ['title' => 'Tambah Produk'])

@section('content')
    <div class="mb-4">
        <h1 class="text-xl font-bold">Tambah Produk</h1>
        <p class="text-sm text-slate-500">Isi data produk baru.</p>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
        <form action="{{ route('admin.products.store') }}" method="POST" class="space-y-4">
            @csrf

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
                <input type="text" name="name" value="{{ old('name') }}"
                    class="mt-1 w-full px-3 py-2 rounded-lg border border-slate-200">
            </div>

            <div>
                <label class="text-sm font-medium">Deskripsi</label>
                <textarea name="description" rows="4" class="mt-1 w-full px-3 py-2 rounded-lg border border-slate-200">{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-medium">Harga</label>
                    <input type="number" name="price" min="0" value="{{ old('price', 0) }}"
                        class="mt-1 w-full px-3 py-2 rounded-lg border border-slate-200">
                </div>

                <div>
                    <label class="text-sm font-medium">Stok</label>
                    <input type="number" name="stock" min="0" value="{{ old('stock', 0) }}"
                        class="mt-1 w-full px-3 py-2 rounded-lg border border-slate-200">
                </div>
            </div>

            <div>
                <label class="text-sm font-medium">Image URL (optional)</label>
                <input type="text" name="image_path" value="{{ old('image_path') }}"
                    placeholder="https://example.com/image.png"
                    class="mt-1 w-full px-3 py-2 rounded-lg border border-slate-200">
                <p class="text-xs text-slate-500 mt-1">Isi URL gambar langsung.</p>
            </div>

            <div class="flex items-center justify-between pt-2">
                <a href="{{ route('admin.products.index') }}" class="text-sm text-slate-600 hover:underline">
                    ← Kembali
                </a>

                <button class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 text-sm font-medium">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection
