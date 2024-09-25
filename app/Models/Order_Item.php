<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'service_id',
        'qty'
    ];

    public function orderItem()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }

    public function generateUniqueTrxId()
    {
        $prefix = '2NDSTORE';
    }
}
