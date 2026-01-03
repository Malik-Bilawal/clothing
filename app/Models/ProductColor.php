<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'name', 'hex_code', 'stock_quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function images()
    {
        // Use the actual column in your table: color_id
        return $this->hasMany(ProductColorImage::class, 'color_id', 'id');
    }

    public function getImageAttribute()
    {
        $image = $this->images()->first();
        return $image ? asset('storage/' . $image->image_path) : null;
    }
}