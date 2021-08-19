<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\ProductVariation;
use App\OrderProductVariationItem;
use App\ProductVariationItem;
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

$factory->define(OrderProductVariationItem::class, function (Faker $faker) {
    return [
      'product_variation_item_id' => request('product_variation_item_id'),
    ];
});
