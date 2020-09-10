<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->bigIncrements('id_peminjaman');
            $table->string('kode_pinjam', 50)->nullable();
            $table->date('tanggal_pinjam')->nullable();
            $table->integer('lama_pinjam')->nullable();
            $table->date('tanggal_kembali')->nullable();
            $table->text('cart')->nullable();
            $table->text('cart_full')->nullable();
            $table->string('status', 10)->nullable();
            $table->bigInteger('user_id')->index()->unsigned();
            $table->bigInteger('admin_id')->index()->unsigned();
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
        Schema::dropIfExists('peminjaman');
    }
}
