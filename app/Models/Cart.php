<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'guest_token',
        'product_id',
        'size_id',
        'color_id',
        'quantity',
        'price',
        'total',
        'item_name',
        'color_name',
        'size_name'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function size()
    {
        return $this->belongsTo(ProductSize::class, 'size_id');
    }

    public function color()
    {
        return $this->belongsTo(ProductColor::class, 'color_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
