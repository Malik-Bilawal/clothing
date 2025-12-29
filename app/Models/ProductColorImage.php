<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColorImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'color_id', 'image_path'
    ];

    public function color()
    {
        return $this->belongsTo(ProductColor::class, 'color_id');
    }
}
