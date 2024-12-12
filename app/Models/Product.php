<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'category_id',
        'image_url',
        'stock',
        'created_at'
    ];

    // Quan hệ với Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Quan hệ với Inventory
    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }

    // Quan hệ với CartItems
    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'product_id');
    }

    // Quan hệ với Wishlist
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'product_id');
    }
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
