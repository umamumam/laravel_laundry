<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'service_id',
        'status_id',
        'quantity',
        'total_price',
        'order_code',
        'jumlah_item',
        'tgl_masuk',   // Ditambahkan agar bisa diisi
        'tgl_selesai', // Ditambahkan agar bisa diisi
    ];

    protected $casts = [
        'tgl_masuk' => 'date',
        'tgl_selesai' => 'date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public static function generateOrderCode()
    {
        return 'LDRY-' . strtoupper(uniqid());
    }

    public function calculateTotalPrice()
    {
        $this->total_price = $this->quantity * $this->service->price;
        $this->save();
    }
}
