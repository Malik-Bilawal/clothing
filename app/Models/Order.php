<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'subtotal',
        'discount',
        'shipping_cost',
        'total',
        'payment_status',
        'status',
        'notes',
    ];

    /* =======================
     |  Relationships
     |=======================*/

    // Order has many items
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function addresses(){
        return $this->hasMany(OrderAddress::class);
    }
    // Shipping address
    public function shippingAddress(): HasOne
    {
        return $this->hasOne(OrderAddress::class)
            ->where('type', 'shipping');
    }

    // Billing address
    public function billingAddress(): HasOne
    {
        return $this->hasOne(OrderAddress::class)
            ->where('type', 'billing');
    }

    // User who placed order (if applicable)
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
