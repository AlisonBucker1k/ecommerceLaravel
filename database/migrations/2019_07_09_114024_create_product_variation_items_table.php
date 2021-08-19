<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductVariationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variation_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_variation_id')->unsigned();
            $table->bigInteger('product_grid_id')->unsigned();
            $table->bigInteger('grid_variation_id')->unsigned();
            $table->timestamps();

            $table->foreign('product_variation_id')->references('id')->on('product_variations')->onDelete('CASCADE');
            $table->foreign('product_grid_id')->references('id')->on('product_grids')->onDelete('CASCADE');
            $table->foreign('grid_variation_id')->references('id')->on('grid_variations')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variation_items');
    }
}
