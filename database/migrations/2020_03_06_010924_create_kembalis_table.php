<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKembalisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kembalis', function (Blueprint $table) {
            $table->bigIncrements('id_kembali');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->bigInteger('admin_id')->unsigned()->index();
            $table->bigInteger('pinjam_id')->unsigned()->index();
            $table->string('kode_kembali', 50)->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->integer('terlambat')->nullable();
            $table->text('cart')->nullable();
            $table->enum('status', ['Clear', 'Telambat', 'Kurang', 'Terlambat & Kurang', 'Complete'])->nullable();
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
        Schema::dropIfExists('kembalis');
    }
}
