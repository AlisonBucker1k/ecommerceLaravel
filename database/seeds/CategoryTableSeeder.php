<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Subcategory;



class CategoryTableSeeder extends Seeder
{
    public function run()
    {
        factory(Category::class, 10)->create()->each(function($category) {
            factory(Subcategory::class, 2)->create([
                'category_id' => $category->id
            ]);
        });
    }

}