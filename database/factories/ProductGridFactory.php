<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Grid;
use App\ProductGrid;
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

$factory->define(ProductGrid::class, function (Faker $faker) {

    $grids   = Grid::all()->pluck('id')->toArray();
    $grid_id = $faker->randomElement($grids);

    return [
        'grid_id' => $grid_id,
    ];
});
