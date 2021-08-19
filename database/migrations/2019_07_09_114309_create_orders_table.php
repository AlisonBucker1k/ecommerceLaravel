<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('customer_id')->unsigned();
            $table->bigInteger('address_id')->unsigned();
            $table->integer('shipping_id')->unsigned();
            $table->decimal('value', 10, 2);
            $table->string('shipping_description')->nullable();
            $table->decimal('shipping_value', 10, 2)->nullable();
            $table->integer('shipping_deadline')->default(0);
            $table->dateTime('sent_at')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('CASCADE');
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('CASCADE');
            $table->foreign('shipping_id')->references('id')->on('shippings')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
