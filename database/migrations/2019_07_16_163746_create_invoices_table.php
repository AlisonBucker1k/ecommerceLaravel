<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('customer_id')->unsigned();
            $table->string('description');
            $table->tinyInteger('type');
            $table->decimal('value', 10, 2);
            $table->decimal('real_value', 10, 2);
            $table->tinyInteger('status');
            $table->bigInteger('order_id')->unsigned()->nullable();
            $table->dateTime('due_at')->nullable();
            $table->dateTime('payment_at')->nullable();
            $table->integer('payment_type')->nullable();
            $table->timestamps();
            $table->unique(['customer_id', 'created_at']);

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('CASCADE');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
