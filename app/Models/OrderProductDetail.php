<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderProductDetail extends Pivot
{
    protected $table = 'order_product_detail';
}
