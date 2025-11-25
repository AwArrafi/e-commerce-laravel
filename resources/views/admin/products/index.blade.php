@extends('admin.layouts.app', ['title' => 'Produk'])

@section('content')
    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-xl font-bold">Kelola Produk</h1>
            <p class="text-sm text-slate-500">Tambah, edit, hapus produk, dan update stok.</p>
        </div>

        <a href="{{ route('admin.products.create') }}"
            class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium
                  bg-blue-600 text-white hover:bg-blue-700">
            + Tambah Produk
        </a>
    </div>

    {{-- Search (opsional, kalau controller belum support tetap aman) --}}
    <form method="GET" class="mb-4">
        <div class="flex gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama produk..."
                class="w-full md:w-96 px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-200">
            <button class="px-4 py-2 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-sm">
                Cari
            </button>
        </div>
    </form>

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50 text-slate-600">
                    <tr class="border-b border-slate-200">
                        <th class="text-left px-4 py-3">Produk</th>
                        <th class="text-right px-4 py-3">Harga</th>
                        <th class="text-center px-4 py-3">Stok</th>
                        <th class="text-center px-4 py-3">Update Stok</th>
                        <th class="text-right px-4 py-3">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-200">
                    @forelse($products as $p)
                        <tr class="hover:bg-slate-50">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-14 h-10 rounded-lg bg-slate-100 overflow-hidden flex items-center justify-center">
                                        @if ($p->image_path)
                                            <img src="{{ $p->image_path }}" alt="{{ $p->name }}"
                                                class="w-full h-full object-contain">
                                        @else
                                            <span class="text-xs text-slate-400">No Img</span>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-semibold">{{ $p->name }}</div>
                                        <div class="text-xs text-slate-500 line-clamp-1">
                                            {{ \Illuminate\Support\Str::limit($p->description, 60) }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-4 py-3 text-right font-medium">
                                Rp {{ number_format($p->price, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                @if ($p->stock > 0)
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-green-50 text-green-700">
                                        {{ $p->stock }}
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-red-50 text-red-700">
                                        Habis
                                    </span>
                                @endif
                            </td>

                            <td class="px-4 py-3 text-center">
                                <form action="{{ route('admin.products.stock', $p->id) }}" method="POST"
                                    class="inline-flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="stock" min="0" value="{{ $p->stock }}"
                                        class="w-24 px-2 py-1 rounded-lg border border-slate-200 text-center">
                                    <button class="px-3 py-1 rounded-lg bg-slate-900 text-white hover:bg-slate-800 text-xs">
                                        Update
                                    </button>
                                </form>
                            </td>

                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.products.edit', $p->id) }}"
                                        class="px-3 py-1 rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-100 text-xs font-medium">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.products.destroy', $p->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="px-3 py-1 rounded-lg bg-red-50 text-red-700 hover:bg-red-100 text-xs font-medium">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-10 text-center text-slate-500">
                                Belum ada produk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-4 py-3 border-t border-slate-200">
            {{ $products->links() }}
        </div>
    </div>
@endsection
