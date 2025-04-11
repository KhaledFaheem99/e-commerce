<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingInformation extends Model {
    protected $fillable = [
        'order_id',
        'user_name',
        'address',
        'first_phone',
        'second_phone',
        'notes'
    ];

    public function order () {
        return $this->belongsTo(Order::class);
    }
}
