<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('no_transaksi', 8);
            $table->char('user_id');
            $table->char('mobil_id');
            $table->char('sopir_id');
            $table->date('tanggal_pesan');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali_rencana');
            $table->date('tanggal_kembali_sebenarnya')->nullable();
            $table->integer('lama_rental');
            $table->integer('lama_denda')->nullable();
            $table->text('kerusakan')->nullable();
            $table->double('biaya_bbm')->nullable();
            $table->double('biaya_kerusakan')->nullable();
            $table->double('biaya_denda')->nullable();
            $table->double('total_bayar');
            $table->double('jumlah_bayar')->nullable();
            $table->double('kembalian')->nullable();
            $table->enum('status_transaksi', ['Proses', 'Mulai', 'Batal', 'Selesai']);
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
        Schema::dropIfExists('transaksi');
    }
}
