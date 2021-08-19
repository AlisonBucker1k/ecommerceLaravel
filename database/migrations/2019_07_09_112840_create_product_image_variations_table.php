<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductImageVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_image_variations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_image_id')->unsigned();
            $table->bigInteger('product_variation_id')->unsigned();
            $table->timestamps();

            $table->foreign('product_image_id')->references('id')->on('product_images')->onDelete('CASCADE');
            $table->foreign('product_variation_id')->references('id')->on('product_variations')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_image_variations');
    }
}
