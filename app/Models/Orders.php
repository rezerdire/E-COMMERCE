<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = [
        'customer_id',
        'payment_method',
        'payment_status',
        'shipping_amount',
        'delivery_status',
        'grand_total',
    ];

    public function customer()
    {
        return $this->belongsTo(Customers::class, );
    }

    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class,  'order_id');
    }
}

