<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_code',
        'cust_name',
        'cust_phone',
        'cust_email',
        'amount',
        'cust_price',
        'is_approve',
        'expired_date',
        'is_active',
        'product_id',
    ];

    public function Products()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
