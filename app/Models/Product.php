<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        "name",
        "price",
        "description",
        "photo",
        "stock",
        "size"
    ];

    public function discountProduct()
    {
        return $this->hasOne(Promo::class, "product_id")->where("start", "<=", now())->where("end", ">=", now());
    }

    public function discount()
    {
        return $this->hasOne(Promo::class, "product_id");
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class, "product_id");
    }
}
