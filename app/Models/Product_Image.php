<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'products_id'
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'products_id');
    }
}
