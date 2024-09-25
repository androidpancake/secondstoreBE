<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'is_paid'
    ];

    public function orderItem()
    {
        return $this->hasMany(Order_Item::class);
    }

    public function review()
    {
        return $this->hasMany(Reviews::class);
    }
}
