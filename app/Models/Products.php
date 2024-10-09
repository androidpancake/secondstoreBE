<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Products extends Model
{
    use HasFactory, SoftDeletes;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'price',
        'thumbnail',
        'year',
        'date_added',
        'condition',
        'defect',
        'stock',
        'is_popular',
        'category_id',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function bookmark()
    {
        return $this->hasMany(Saved::class);
    }

    public function productImage()
    {
        return $this->hasMany(Product_Image::class);
    }

    public function categories()
    {
        return $this->belongsTo(Categories::class, 'category_id', 'id');
    }
}
