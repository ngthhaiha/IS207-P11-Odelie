<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id',
        'active'
    ];

    

    // public function products()
    // {
    //     return $this->hasMany(Product::class, 'menu_id', 'id');
    // }
}
