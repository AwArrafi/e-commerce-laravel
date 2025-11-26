<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        // riwayat pembelian user login
        $orders = Order::where('user_id', Auth::id())
            ->latest()
            ->withCount('items')
            ->get();

        return view('orders.index', compact('orders'));
    }
}
