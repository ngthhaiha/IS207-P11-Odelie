<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'price',
        'thumb',
        'stock',
        'isActive'
    ];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id')
            ->withDefault(['name' => '']);
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
