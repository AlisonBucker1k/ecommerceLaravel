<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Address;
use App\Customer;
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

$factory->define(Address::class, function (Faker $faker) {

    $customer_id = request('customer_id');

    return [
        'customer_id' => $customer_id,
        'postal_code' => getOnlyNumber($faker->postcode),
        'country' => $faker->countryCode,
        'city' => $faker->city,
        'state' => $faker->stateAbbr,
        'status' => $faker->randomElement([0, 1]),
        'district' => $faker->city,
        'street' => $faker->streetAddress,
        'number' => $faker->randomNumber(),
        'reference' => $faker->text,
        'complement' => $faker->text,
    ];
});
