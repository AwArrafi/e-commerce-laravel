<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductAdminController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'image_path' => 'nullable|string', // kamu pakai URL langsung
        ]);

        Product::create($data);

        return redirect()->route('admin.products.index')
            ->with('toast', ['type' => 'success', 'message' => 'Produk berhasil ditambahkan.']);
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'image_path' => 'nullable|string',
        ]);

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('toast', ['type' => 'success', 'message' => 'Produk berhasil diupdate.']);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('toast', ['type' => 'danger', 'message' => 'Produk berhasil dihapus.']);
    }

    public function updateStock(Request $request, Product $product)
    {
        $data = $request->validate([
            'stock' => 'required|integer|min:0',
        ]);

        $product->update(['stock' => $data['stock']]);

        return back()->with('toast', ['type' => 'success', 'message' => 'Stok berhasil diperbarui.']);
    }
}
