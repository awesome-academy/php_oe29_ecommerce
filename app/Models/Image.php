<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'image_link',
        'product_id',
    ];

    public $timestamps = true;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
