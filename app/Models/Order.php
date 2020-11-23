<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'address',
        'phone',
        'total_price',
        'note',
        'status',
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productDetails()
    {
        return $this->belongsToMany(ProductDetail::class)->withPivot(['quantity', 'unit_price'])->withTimestamps();
    }
}
