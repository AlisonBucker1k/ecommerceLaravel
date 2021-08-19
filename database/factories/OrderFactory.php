<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
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

$factory->define(Order::class, function (Faker $faker) {
    return [
        'value' => $faker->numberBetween(5, 1000),
        'shipping_value' => $faker->numberBetween(0, 100),
        'shipping_deadline' => $faker->numberBetween(1, 10),
        'sent_at' => now(),
        'status' => \App\Enums\OrderStatus::getRandomValue(),
        'shipping_id' => \App\Enums\Shipping::getRandomValue(),
    ];
});