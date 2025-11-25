@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-8 bg-white shadow rounded-lg px-6">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-2xl font-bold mb-1">Invoice</h1>
                <p class="text-sm text-gray-500">Nomor: {{ $order->invoice_number }}</p>
                <p class="text-sm text-gray-500">Tanggal: {{ $order->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <div class="text-right text-xs text-gray-600">
                <p class="font-semibold text-sm">Toko Alat Kesehatan Mitra</p>
                <p>Jl. Sangkulirang No. 123</p>
                <p>Telp: 0812-0000-0000</p>
            </div>
        </div>

        <div class="mb-6 text-sm">
            <h2 class="font-semibold mb-1">Kepada Yth.</h2>
            <p>{{ $order->customer_name }}</p>
            @if ($order->customer_address)
                <p class="text-gray-500">{{ $order->customer_address }}</p>
            @endif
            @if ($order->customer_phone)
                <p class="text-gray-500">Telp: {{ $order->customer_phone }}</p>
            @endif
        </div>

        <table class="w-full text-sm border-t border-b mb-6">
            <thead>
                <tr class="border-b">
                    <th class="text-left py-2">Produk</th>
                    <th class="text-center py-2">Qty</th>
                    <th class="text-right py-2">Harga</th>
                    <th class="text-right py-2">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr class="border-b">
                        <td class="py-2">
                            {{ $item->product->name ?? '-' }}
                        </td>
                        <td class="py-2 text-center">{{ $item->quantity }}</td>
                        <td class="py-2 text-right">
                            Rp {{ number_format($item->unit_price, 0, ',', '.') }}
                        </td>
                        <td class="py-2 text-right">
                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex justify-end mb-4">
            <div class="w-64">
                <div class="flex justify-between text-sm mb-1">
                    <span class="font-medium">Total</span>
                    <span class="font-bold">
                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>

        <div class="flex justify-end text-xs text-gray-500">
            <p>Terima kasih telah berbelanja di Toko Alat Kesehatan Mitra.</p>
        </div>

        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('products.index') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium
              bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                ← Kembali Belanja
            </a>

            <a href="{{ route('orders.invoice.pdf', $order->id) }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium
              bg-blue-600 text-white rounded hover:bg-blue-700">
                Download PDF
            </a>
        </div>



    </div>
@endsection
