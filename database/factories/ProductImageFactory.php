<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductImage;
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

$factory->define(ProductImage::class, function (Faker $faker) {

    return [
        'file' => 'http://via.placeholder.com/800x600',
        'main' => 1
    ];

});
