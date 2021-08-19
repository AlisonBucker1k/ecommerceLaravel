<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductVariationItem;
use App\Grid;
use App\GridVariation;
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

$factory->define(ProductVariationItem::class, function (Faker $faker) {

    return [
        'product_grid_id' => request('product_grid_id'),
        'product_variation_id'=> request('product_variation_id'),
        'grid_variation_id'=> request('grid_variation_id'),
    ];

});
