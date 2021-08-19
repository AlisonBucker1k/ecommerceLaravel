<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductVariationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_product_variation_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_product_id')->unsigned();
            $table->bigInteger('product_variation_item_id')->unsigned();
            $table->string('grid_description');
            $table->string('grid_variation_description');
            $table->timestamps();

            $table->foreign('order_product_id')->references('id')->on('order_products')->onDelete('CASCADE');
            $table->foreign('product_variation_item_id')->references('id')->on('product_variation_items')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_product_variation_items');
    }
}
