<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dendas', function (Blueprint $table) {
            $table->bigIncrements('id_denda');
            $table->string('kode_denda', 100)->nullable();
            $table->integer('terlambat')->nullable();
            $table->date('tanggal_denda')->nullable();
            $table->integer('total_denda')->nullable();
            $table->integer('bayar_denda')->nullable();
            $table->enum('status', ['Kurang', 'Lunas'])->nullable();
            $table->unsignedBigInteger('kembali_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('admin_id')->index();
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
        Schema::dropIfExists('dendas');
    }
}
