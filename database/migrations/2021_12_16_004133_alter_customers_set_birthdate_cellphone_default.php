<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCustomersSetBirthdateCellphoneDefault extends Migration
{
    public function up()
    {
        Schema::table('customer_profiles', function (Blueprint $table) {
            $table->string('phone')->default('+55279190081')->change();
            $table->string('cellphone')->default('+55279190081')->change();
            $table->string('birth_date')->default('1993-03-28')->change();
        });
    }
}
