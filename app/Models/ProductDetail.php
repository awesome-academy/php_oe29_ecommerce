<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductDetail extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'size',
        'quantity',
        'product_id',
    ];

    public $timestamps = true;

    public function product()
    {
        return $this->belongsTo(Product::class)->withTrashed();
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
