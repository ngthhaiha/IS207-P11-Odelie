<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'created_at'
    ];

    // Quan hệ 1-n với CartItems
    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }

    // Quan hệ 1-1 với User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
