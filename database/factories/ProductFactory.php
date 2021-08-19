<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Product;
use Faker\Generator as Faker;
use App\Enums\CategoryStatus;

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

$factory->define(Product::class, function (Faker $faker) {

    $category   = Category::where('status', CategoryStatus::ACTIVE)->get()->pluck('id')->toArray();
    $categoryId = $faker->randomElement($category);
    $category   = Category::findOrFail($categoryId);

    $subcategories = [];

    foreach($category->subCategories as $subCategory):
        $subcategories[] = $subCategory->id;
    endforeach;

    $subCategoryId = $faker->randomElement($subcategories);

    return [
        'category_id' => $categoryId,
        'subcategory_id' => $subCategoryId,
        'name' => $faker->sentence(6, true),
        'slug' => $faker->unique()->slug,
        'description' => $faker->paragraphs( 1, true),
        'has_grid_variation' => $faker->randomElement([0, 1]),
        'highlighted' => $faker->randomElement([0, 1]),
        'status' => $faker->randomElement([0, 1]),
    ];
});
