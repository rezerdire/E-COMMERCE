<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
     use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unit_amount',
        'total_amount',
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class,  'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}
