<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOrdersTableAddPagarMeColumns extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('pagar_me_transaction_id')->nullable()->default(null);
            $table->string('pagar_me_json')->nullable()->default(null);
        });
    }
}
