<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index()
    {
        // tampil keranjang
        $cart = session('cart', []);

        $total = collect($cart)->sum(function ($item) {
            return $item['subtotal'];
        });

        return view('cart.index', compact('cart', 'total'));
    }


    // tambah keranjang
    public function add(Request $request, Product $product)
    {
        $quantity = (int) $request->input('quantity', 1);
        if ($quantity < 1) {
            $quantity = 1;
        }

        $cart = session()->get('cart', []);

        $existingQty = isset($cart[$product->id]) ? $cart[$product->id]['quantity'] : 0;
        $newQty = $existingQty + $quantity;

        // ⬇️ cek stok
        if ($newQty > $product->stock) {
            return redirect()->route('cart.index')
                ->with('error', 'Stok produk "' . $product->name . '" tidak mencukupi. Stok tersisa: ' . $product->stock);
        }

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $newQty;
            $cart[$product->id]['subtotal'] = $newQty * $cart[$product->id]['price'];
        } else {
            $cart[$product->id] = [
                'product_id' => $product->id,
                'name'       => $product->name,
                'price'      => $product->price,
                'quantity'   => $quantity,
                'subtotal'   => $quantity * $product->price,
            ];
        }

        session(['cart' => $cart]);

        return redirect()->route('products.index')
            ->with('success', 'Produk ditambahkan ke keranjang.');
    }


    public function update(Request $request, Product $product)
    {
        $quantity = (int) $request->input('quantity', 1);
        if ($quantity < 1) {
            $quantity = 1;
        }

        // cek stock
        if ($quantity > $product->stock) {
            return redirect()->route('cart.index')
                ->with('error', 'Stok produk "' . $product->name . '" tidak mencukupi. Stok tersisa: ' . $product->stock);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $quantity;
            $cart[$product->id]['subtotal'] =
                $quantity * $cart[$product->id]['price'];
            session(['cart' => $cart]);
        }

        return redirect()->route('cart.index')
            ->with('success', 'Jumlah produk diperbarui.');
    }


    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session(['cart' => $cart]);
        }

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }
}
