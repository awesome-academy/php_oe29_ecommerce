<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'message',
        'status',
        'rate',
        'product_id',
        'user_id',
        'parent_id',
    ];

    public $timestamps = true;

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
