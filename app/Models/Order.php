<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_id',
        'user_id',
        'total_price',
        'status'
    ];

    public function orderItems () {
        return $this->hasMany(OrderItem::class);
    }

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function shippingInformation () {
        return $this->hasOne(ShippingInformation::class);
    }
}
