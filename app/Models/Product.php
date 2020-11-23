<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'rate',
        'original_price',
        'current_price',
        'category_id',
        'brand_id',
    ];

    public $timestamps = true;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function productDetails()
    {
        return $this->hasMany(ProductDetail::class);
    }

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class);
    }
}
