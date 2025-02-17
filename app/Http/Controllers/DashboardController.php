<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Service;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCustomers = Customer::count(); // Menghitung jumlah pelanggan
        $totalRevenue = Order::sum('total_price'); // Menghitung total pendapatan
        $totalOrder = Order::count();
        $totalLayanan = Service::count();

        return view('dashboard', compact('totalCustomers', 'totalRevenue', 'totalOrder', 'totalLayanan'));
    }
}
