<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function getModel()
    {
        return Product::class;
    }

    public function getCountImageAndProductDetail()
    {
        $products = Product::withCount(['images', 'productDetails'])->get();

        return $products;
    }

    public function getRelated($id, $data)
    {
        if (count($data) != 0) {
            $products = Product::with($data)->find($id);

            return $products;
        }

        return false;
    }

    public function getLasted()
    {
        $products = Product::with('images')
            ->orderBy('created_at', 'DESC')
            ->take(config('setting.number_product'))
            ->get();

        return $products;
    }

    public function paginate($number = 0)
    {
        if ($number > 0) {
            return Product::paginate($number);
        }

        return Product::paginate(config('setting.paginate.product'));
    }

    public function filterWhere($priceFrom, $priceTo)
    {
        if ($priceTo == 0) {
            return Product::where('current_price', '>=', $priceFrom)
                ->orderBy('current_price')
                ->paginate(config('setting.paginate.product'));
        }

        return Product::whereBetween('current_price', [$priceFrom, $priceTo])
            ->orderBy('current_price')
            ->paginate(config('setting.paginate.product'));
    }
}
