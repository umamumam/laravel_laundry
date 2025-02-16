<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Layanan Laundry</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            font-size: 14px; 
            margin: 20px;
        }
        .container { 
            width: 80%; 
            margin: 0 auto; 
            border: 1px solid #ddd; 
            padding: 20px; 
            border-radius: 10px;
        }
        .header { 
            text-align: center; 
            font-size: 20px; 
            font-weight: bold; 
            margin-bottom: 20px;
            text-transform: uppercase;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 20px;
        }
        th, td { 
            padding: 10px; 
            border: 1px solid #ddd; 
            text-align: left;
        }
        th { 
            background-color: #f8f9fa; 
            font-weight: bold;
        }
        .text-center { 
            text-align: center;
            font-size: 16px;
            margin-top: 20px;
        }
        .total-price {
            font-weight: bold;
            color: #d9534f;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">Bukti Layanan Laundry</div>
        <table>
            <tr>
                <th>Kode Pesanan</th>
                <td>{{ $order->order_code }}</td>
            </tr>
            <tr>
                <th>Pelanggan</th>
                <td>{{ $order->customer->name }}</td>
            </tr>
            <tr>
                <th>Layanan</th>
                <td>{{ $order->service->service_name }}</td>
            </tr>
            <tr>
                <th>Jumlah Item</th>
                <td>{{ $order->jumlah_item }}</td>
            </tr>
            <tr>
                <th>Berat (Kg)</th>
                <td>{{ $order->quantity }} Kg</td>
            </tr>
            <tr>
                <th>Total Harga</th>
                <td class="total-price">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $order->status->status_name }}</td>
            </tr>
            <tr>
                <th>Tanggal Masuk</th>
                <td>{{ $order->tgl_masuk->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <th>Tanggal Selesai</th>
                <td>{{ $order->tgl_selesai->format('d-m-Y') }}</td>
            </tr>
        </table>

        <div class="text-center">
            <p>Terima kasih telah menggunakan layanan kami.</p>
        </div>
    </div>
</body>
</html>
