<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\OrderProductDetail;
use Faker\Generator as Faker;

$factory->define(OrderProductDetail::class, function (Faker $faker) {
    return [
        'quantity' => $faker->numberBetween(1, 100),
        'unit_price' => $faker->numberBetween(100000, 1000000),
    ];
});
