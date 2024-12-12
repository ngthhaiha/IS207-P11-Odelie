<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'color', 'size', 'stock'
    ];

    // Quan hệ ngược lại với Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
