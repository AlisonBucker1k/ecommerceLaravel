<?php

use Illuminate\Database\Seeder;
use App\Grid;
use App\GridVariation;


class GridTableSeeder extends Seeder
{
    public function run()
    {
        factory(Grid::class, 10)->create()->each(function($grid) {
            factory(GridVariation::class, 5)->create([
                'grid_id'   => $grid->id,
                'status'    => $grid->status
            ]);
        });
    }

}