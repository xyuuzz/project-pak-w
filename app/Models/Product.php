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
        "size",
        "weight",
    ];

    public function discountProduct()
    {
        return $this->hasOne(Promo::class, "product_id")->whereDate("start", "<=", now())->where("end", ">=", now());
    }

    public function discount()
    {
        return $this->hasMany(Promo::class, "product_id");
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class, "product_id");
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class, "product_id");
    }

    public function promos()
    {
        return $this->hasMany(Product::class, "product_id");
    }
}
