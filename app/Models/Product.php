<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'rating','sku', 'default_image', 'category_id', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        
    ];

    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    
    public function defaultImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_default', 1);
    }
    
    public function galleryImages()
    {
        return $this->hasMany(ProductImage::class)->where('is_default', 0);
    }
    

    public function colors(){
        return $this->hasMany(ProductColor::class);
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }
    

    public function reviews()
    {
        return $this->hasMany(Review::class)->latest();
    }

    // THE MAGIC FUNCTION
    public function currentUserHasPurchased()
    {
        if (!Auth::check()) return false;

        return \App\Models\Order::where('user_id', Auth::id())
            ->whereIn('status', ['delivered', 'completed', 'shipped']) 
            ->whereHas('items', function ($query) {
                $query->where('product_id', $this->id);
            })
            ->exists();
    }
    
    public function currentUserHasReviewed()
    {
        if (!Auth::check()) return false;
        return $this->reviews()->where('user_id', Auth::id())->exists();
    }
}

