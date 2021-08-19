<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\ProductVariation;
use App\OrderProduct;
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

$factory->define(OrderProduct::class, function (Faker $faker) {
    $products  = Product::all()->pluck('id')->toArray();
    $productId = $faker->randomElement($products);

    $product = Product::query()->find($productId);

    $productVariations = ProductVariation::where('product_id', $productId)->pluck('id')->toArray();
    $productVariationId = $faker->randomElement($productVariations);

    $productVariation = ProductVariation::find($productVariationId);

    $quantity = $faker->numberBetween(1, 10);

    return [
        'product_id' => $productId,
        'product_variation_id' => $productVariationId,
        'value' => $productVariation->value,
        'final_value' => $productVariation->final_price,
        'subtotal_value' => $quantity * $productVariation->final_price,
        'discount_percent' => $productVariation->discount_percent,
        'promotion_value' => $faker->numberBetween(0, 100),
        'quantity' => $quantity,
        'name' => $product->name,
        'description' => $product->description,
        'image' => $productVariation->image
    ];
});