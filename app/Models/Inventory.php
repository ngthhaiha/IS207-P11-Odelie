<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'stock',
        'created_at',
        'last_updated'
    ];

    // Quan hệ với Product
    public function product()
    {
        return $this->belongsTo(Product::class);
   }
}
