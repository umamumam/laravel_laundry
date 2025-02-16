<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Status;
use App\Models\Service;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\OrdersExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();

        // Filter berdasarkan tanggal masuk
        if ($request->filled('tgl_masuk_awal') && $request->filled('tgl_masuk_akhir')) {
            $query->whereBetween('tgl_masuk', [$request->tgl_masuk_awal, $request->tgl_masuk_akhir]);
        }

        // Filter berdasarkan pencarian nama pelanggan atau kode pesanan
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('order_code', 'like', '%' . $request->search . '%')
                    ->orWhereHas('customer', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->search . '%');
                    });
            });
        }

        $orders = $query->paginate(10);

        return view('orders.index', compact('orders'));
    }


    public function create()
    {
        $customers = Customer::all();
        $services = Service::all();
        $statuses = Status::all();
        return view('orders.create', compact('customers', 'services', 'statuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id'  => 'required|exists:services,id',
            'quantity'    => 'required|integer|min:1',
            'jumlah_item' => 'required|integer|min:1',
            'tgl_masuk'   => 'required|date',
            'tgl_selesai' => 'nullable|date|after_or_equal:tgl_masuk',
        ]);

        $service = Service::findOrFail($request->service_id);
        $total_price = $service->price * $request->quantity;

        Order::create([
            'order_code'  => 'ORD-' . strtoupper(Str::random(6)),
            'customer_id' => $request->customer_id,
            'service_id'  => $request->service_id,
            'quantity'    => $request->quantity,
            'jumlah_item' => $request->jumlah_item,
            'tgl_masuk'   => $request->tgl_masuk,
            'tgl_selesai' => $request->tgl_selesai,
            'total_price' => $total_price,
            'status_id'   => 1,
        ]);

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil ditambahkan.');
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $customers = Customer::all();
        $services = Service::all();
        $statuses = Status::all();
        return view('orders.edit', compact('order', 'customers', 'services', 'statuses'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'customer_id'  => 'required|exists:customers,id',
            'service_id'   => 'required|exists:services,id',
            'quantity'     => 'required|integer|min:1',
            'jumlah_item'  => 'required|integer|min:1',
            'status_id'    => 'required|exists:statuses,id',
            'tgl_masuk'    => 'required|date',
            'tgl_selesai'  => 'nullable|date|after_or_equal:tgl_masuk',
        ]);

        $service = Service::findOrFail($request->service_id);
        $total_price = $service->price * $request->quantity;

        $order->update([
            'customer_id' => $request->customer_id,
            'service_id'  => $request->service_id,
            'status_id'   => $request->status_id,
            'quantity'    => $request->quantity,
            'jumlah_item' => $request->jumlah_item,
            'total_price' => $total_price,
            'tgl_masuk'   => $request->tgl_masuk,
            'tgl_selesai' => $request->tgl_selesai,
        ]);

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }

    public function generatePDF($id)
    {
        $order = Order::with(['customer', 'service', 'status'])->findOrFail($id);
        $pdf = PDF::loadView('orders.pdf', compact('order'));

        return $pdf->download('bukti_layanan_' . $order->order_code . '.pdf');
    }

    public function updateStatus($id)
    {
        $order = Order::findOrFail($id);
        $nextStatus = Status::where('id', '>', $order->status_id)->orderBy('id')->first();

        if ($nextStatus) {
            $order->status_id = $nextStatus->id;
            $order->save();

            return response()->json([
                'success' => true,
                'new_status' => $nextStatus->status_name
            ]);
        }

        return response()->json(['success' => false]);
    }

    public function bulkUpdateStatus(Request $request)
    {
        if (!$request->has('order_ids')) {
            return back()->with('error', 'Tidak ada pesanan yang dipilih.');
        }

        $orders = Order::whereIn('id', $request->order_ids)->get();

        foreach ($orders as $order) {
            $nextStatus = Status::where('id', '>', $order->status_id)->orderBy('id')->first();
            if ($nextStatus) {
                $order->status_id = $nextStatus->id;
                $order->save();
            }
        }

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function exportExcel()
    {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }
}
