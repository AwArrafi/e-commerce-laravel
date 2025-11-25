<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // form checkout 
    public function index()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('products.index')
                ->with('success', 'Keranjang belanja masih kosong.');
        }

        $total = collect($cart)->sum(fn($item) => $item['subtotal']);

        return view('checkout.index', compact('cart', 'total'));
    }

    // proses simpan order
    public function store(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('products.index')
                ->with('success', 'Keranjang belanja masih kosong.');
        }

        $total = collect($cart)->sum(fn($item) => $item['subtotal']);

        $data = $request->validate([
            'customer_name'    => 'required|string|max:255',
            'customer_email'   => 'nullable|email',
            'customer_phone'   => 'nullable|string|max:30',
            'customer_address' => 'nullable|string',
        ]);

        // cek stok 
        foreach ($cart as $item) {
            $product = Product::find($item['product_id']);

            if (! $product) {
                return redirect()->route('cart.index')
                    ->with('error', 'Produk dengan ID ' . $item['product_id'] . ' tidak ditemukan.');
            }

            if ($product->stock < $item['quantity']) {
                return redirect()->route('cart.index')
                    ->with('error', 'Stok produk "' . $product->name . '" tidak mencukupi. Stok tersisa: ' . $product->stock);
            }
        }

        //buat order
        $invoiceNumber = 'INV-' . now()->format('Ymd') . '-' . Str::upper(Str::random(5));

        $order = Order::create([
            'user_id'          => Auth::id(),
            'invoice_number'   => $invoiceNumber,
            'customer_name'    => $data['customer_name'],
            'customer_email'   => $data['customer_email'] ?? null,
            'customer_phone'   => $data['customer_phone'] ?? null,
            'customer_address' => $data['customer_address'] ?? null,
            'total_amount'     => $total,
        ]);

        //simpan item dan kurangi stok
        foreach ($cart as $item) {
            $product = Product::find($item['product_id']);

            if (! $product) {
                continue;
            }

            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $product->id,
                'quantity'   => $item['quantity'],
                'unit_price' => $item['price'],
                'subtotal'   => $item['subtotal'],
            ]);

            // kurangi stok
            $product->decrement('stock', $item['quantity']);
        }

        session()->forget('cart');

        return redirect()->route('orders.invoice', $order->id)
            ->with('success', 'Checkout berhasil.');
    }

    // tampilkan invoice
    public function invoice(Order $order)
    {
        $order->load('items.product');

        return view('orders.invoice', compact('order'));
    }
}
