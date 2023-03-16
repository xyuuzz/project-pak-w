<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        "role",
        "photo_profile",
        "social_id",
        "social_type",
        "phone_number",
        "address",
        "province",
        "city",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        "two_factor_recovery_codes",
        "two_factor_secret"
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    public function getProvinceAttribute($value)
    {
        if($value == null) return null;
        return json_decode($value);
    }

    public function getCityAttribute($value)
    {
        if($value == null) return null;
        return json_decode($value);
    }

    public function isAdmin()
    {
        return $this->role === "admin";
    }

    public function isUser()
    {
        return $this->role === "user";
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
