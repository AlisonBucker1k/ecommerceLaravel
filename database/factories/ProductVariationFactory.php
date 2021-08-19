<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductVariation;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(ProductVariation::class, function (Faker $faker) {

    $product_id = request('product_id');
    $value = $faker->numberBetween(10, 10000);
    $discount_percent = $faker->numberBetween(0, 50);
    $promotionValue = $value - (($discount_percent / 100) * $value);

    return [
        'product_id' => $product_id,
        'value' => $value,
        'discount_percent' => $discount_percent,
        'promotion_value' => $promotionValue,
        'cost_value' => $faker->numberBetween(0, 1000),
        'height' => $faker->numberBetween(20, 40),
        'width' => $faker->numberBetween(20, 40),
        'length' => $faker->numberBetween(20, 40),
        'weight' => $faker->numberBetween(0, 40),
        'main' => 1,
        'stock_quantity' => $faker->numberBetween(0, 1000),
        'status' => $faker->numberBetween(0, 1),
        'highlighted' => $faker->numberBetween(0, 1)
    ];
});
