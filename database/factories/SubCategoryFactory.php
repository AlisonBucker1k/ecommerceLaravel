<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Subcategory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(Subcategory::class, function (Faker $faker) {

    $category_id = request('category_id');
    $name = $faker->unique()->word;

    return [
        'category_id' => $category_id,
        'name' => Str::ucfirst($name),
        'slug' => $name,
        'status' => 1,
    ];
});
