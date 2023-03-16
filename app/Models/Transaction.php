<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "product_id",
        "quantity",
        "total_price",
        "bukti_pembayaran", // nullable
        "no_resi",
        "bukti_telah_dikirim",
        "status",
        "shipping_method",
        "payment_method",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function promo()
    {
        return $this->belongsTo(Promo::class);
    }
}
