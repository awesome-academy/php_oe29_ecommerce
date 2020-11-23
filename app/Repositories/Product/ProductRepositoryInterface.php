<?php

namespace App\Repositories\Product;

interface ProductRepositoryInterface
{
    public function getCountImageAndProductDetail();

    public function getRelated($id, $data);

    public function getLasted();

    public function paginate($number = 0);

    public function filterWhere($priceFrom, $priceTo);
}
