<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $guarded = [];
    protected $dates = ['tanggal_pesan', 'tanggal_pinjam', 'tanggal_kembali_rencana', 'tanggal_kembali_sebenarnya'];
}
