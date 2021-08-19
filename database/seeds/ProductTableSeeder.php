<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\ProductVariation;
use App\ProductVariationItem;
use App\ProductImage;
use App\ProductGrid;
use App\GridVariation;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
{
    public function run()
    {
        factory(Product::class, 20)->create()->each(function($product) {
            factory(ProductImage::class, 5)->create([
                'product_id' => $product->id,
            ]);

            factory(ProductGrid::class, 1)->create([
                'product_id' => $product->id,
            ]);

            factory(ProductVariation::class, 1)->create([
                'product_id' => $product->id,
            ])->each(function($productVariation) {
                $grid = ProductGrid::where('product_id', $productVariation->product_id)->orderBy(DB::raw('RAND()'))->first();
                $gridVariation = GridVariation::query()->where('grid_id', $grid->grid_id)->orderBy(DB::raw('RAND()'))->first();
                factory(ProductVariationItem::class, 1)->create([
                    'product_grid_id' => $grid->id,
                    'product_variation_id' => $productVariation->id,
                    'grid_variation_id' => $gridVariation->id
                ]);
            });
        });
    }
}