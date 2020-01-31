<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSopirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sopir', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('nik', 13);
            $table->char('no_sim', 20);
            $table->string('nama_sopir', 50);
            $table->char('no_hp', 15);
            $table->text('alamat');
            $table->double('tarif_perhari');
            $table->enum('jenis_kelamin', ['P', 'L']);
            $table->enum('status_sopir', ['Sibuk', 'Dipesan', 'Luang']);
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
        Schema::dropIfExists('sopir');
    }
}
