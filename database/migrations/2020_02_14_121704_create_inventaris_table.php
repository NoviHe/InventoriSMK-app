<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaris', function (Blueprint $table) {
            $table->bigIncrements('id_inventaris');
            $table->string('nama')->nullable();
            $table->string('kondisi')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('jumlah')->nullable();
            $table->date('tanggal_registrasi')->nullable();
            $table->string('kode_inventaris', 10)->nullable();
            $table->unsignedBigInteger('id_jenis');
            $table->unsignedBigInteger('id_ruang');
            $table->unsignedBigInteger('id_admin');
            $table->unsignedBigInteger('id_kategori');
            $table->timestamps();
            $table->index('id_jenis');
            $table->index('id_ruang');
            $table->index('id_admin');
            $table->index('id_kategori');
            $table->foreign('id_jenis')->references('id_jenis')->on('jenis')->onDelete('cascade');
            $table->foreign('id_ruang')->references('id_ruang')->on('ruangs')->onDelete('cascade');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategoris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventaris');
    }
}
