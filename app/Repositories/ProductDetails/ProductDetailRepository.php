<?php

namespace App\Repositories\ProductDetails;

use App\Repositories\BaseRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Models\ProductDetail;

class ProductDetailRepository extends BaseRepository implements ProductDetailRepositoryInterface
{
    public function getModel()
    {
        return ProductDetail::class;
    }
}
