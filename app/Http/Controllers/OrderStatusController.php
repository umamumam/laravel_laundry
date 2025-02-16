<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderStatusController extends Controller
{
    public function index()
    {
        return view('orders.status');
    }

    public function check(Request $request)
    {
        $request->validate([
            'order_code' => 'required|string'
        ]);

        $order = Order::where('order_code', $request->order_code)->first();

        if ($order) {
            return view('orders.status', compact('order'));
        } else {
            return view('orders.status')->with('not_found', true);
        }
    }
}

