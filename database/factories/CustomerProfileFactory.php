<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\CustomerProfile;
use Illuminate\Support\Str;
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

$factory->define(CustomerProfile::class, function (Faker $faker) {

    $customer_id = request('customer_id');

    return [
        'name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'phone' => $faker->phoneNumber,
        'cpf' => $faker->cpf,
        'birth_date' => $faker->date('Y-m-d'),
        'cellphone' => $faker->phoneNumber,
        'customer_id' => $customer_id,
    ];
});
