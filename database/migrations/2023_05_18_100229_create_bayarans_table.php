<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bayarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('checkout_id');
            $table->string('order_id');
            $table->string('snaptoken');
            $table->string('transaction_status');
            $table->integer('gross_amount');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bayarans');
    }
}
