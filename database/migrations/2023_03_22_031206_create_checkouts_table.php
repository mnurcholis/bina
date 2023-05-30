<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->string('id_buku');
            $table->string('status');
            $table->integer('qty');
            $table->integer('total');
            $table->integer('id_user');
            $table->text('alamat')->nullable();
            $table->integer('provinsi')->nullable();
            $table->integer('kabkot')->nullable();
            $table->integer('ongkir')->nullable();
            $table->string('kurir')->nullable();
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
        Schema::dropIfExists('checkouts');
    }
}
