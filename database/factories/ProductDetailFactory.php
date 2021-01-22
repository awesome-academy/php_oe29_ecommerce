<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductDetail;
use App\Models\OrderProductDetail;
use Faker\Generator as Faker;

$factory->define(ProductDetail::class, function (Faker $faker) {
    return [
        'id' => $faker->unique()->numberBetween(1, 1000),
        'product_id' => 1,
        'size' => $faker->numberBetween(30, 50),
        'quantity' => $faker->numberBetween(1, 1000),
        'deleted_at' => null,
        'created_at' => new DateTime,
        'updated_at' => new DateTime,
    ];
});
