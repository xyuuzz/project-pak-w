<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = [
        "product_id",
        "description",
        "start",
        "end",
        "new_price"
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getStartAttribute($value)
    {
        return date("d-m-Y H:i", strtotime($value));
    }

    public function getEndAttribute($value)
    {
        return date("d-m-Y H:i", strtotime($value));
    }

//    public function getNewPriceAttribute($value)
//    {
//        return "Rp. " . number_format($value, 0, ",", ".");
//    }

    public function checkActive()
    {
        if((now()->diffInMinutes(\Carbon\Carbon::parse($this->start)) - 420) < 0  // cek apakah sudah mulai
        && (now()->diffInMinutes(\Carbon\Carbon::parse($this->end)) - 420) > 0) { // cek apakah sudah selesai
            return true;
        } else {
            return false;
        }
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class, "promo_id");
    }
}
