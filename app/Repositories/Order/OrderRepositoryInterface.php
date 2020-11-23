<?php

namespace App\Repositories\Order;

interface OrderRepositoryInterface
{
    public function orderBy($column, $attributes = []);
}
