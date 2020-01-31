<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobil', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_plat', 10);
            $table->string('kode_merk', 20);
            $table->string('kode_tipe', 20);
            $table->double('harga_sewa');
            $table->string('foto_mobil', 100);
            $table->string('jenis_mobil', 20)->nullable();
            $table->enum('transmisi', ['Manual', 'CVT', 'Matic'])->nullable();
            $table->enum('status_rental', ['Jalan', 'Dipesan', 'Kosong']);
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
        Schema::dropIfExists('mobil');
    }
}
