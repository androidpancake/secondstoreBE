<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSavedItems extends Model
{
    use HasFactory;

    protected $table = 'saveds';

    protected $fillable = [
        'user_id',
        'product_id'
    ];

    public function user()
    {
        return $this->belongsToMany(Products::class, 'product_id');
    }

}
