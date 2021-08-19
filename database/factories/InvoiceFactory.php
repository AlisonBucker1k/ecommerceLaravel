<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Invoice;
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

$factory->define(Invoice::class, function (Faker $faker) {

    return [
        'payment_type' => 1,
        'due_at' => now(),
        'payment_at' => now(),
        'description' => $faker->sentence(6, true),
        'type' => 1,
        'real_value' => $faker->randomElement([0, 1000]),
        'status' => 0,
    ];
});

