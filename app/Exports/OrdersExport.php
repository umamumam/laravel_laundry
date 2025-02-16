<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Order::with(['customer', 'service', 'status'])->get();
    }

    public function headings(): array
    {
        return [
            'Kode Pesanan', 'Nama Pelanggan', 'Layanan', 'Jumlah (Kg)',
            'Jumlah Item', 'Total Harga', 'Tgl Masuk', 'Tgl Selesai', 'Status'
        ];
    }

    public function map($order): array
    {
        return [
            $order->order_code,
            $order->customer->name,
            $order->service->service_name,
            $order->quantity,
            $order->jumlah_item,
            'Rp ' . number_format($order->total_price, 0, ',', '.'),
            $order->tgl_masuk->format('d-m-Y'),
            $order->tgl_selesai->format('d-m-Y'),
            $order->status->status_name
        ];
    }
}
