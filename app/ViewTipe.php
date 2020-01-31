<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViewTipe extends Model
{
    protected $table = 'view_tipe';
    /*
    select `tipe`.`id` AS `id`,`tipe`.`kode_tipe` AS `kode_tipe`,`tipe`.`nama_tipe` AS `nama_tipe`,`tipe`.`kode_merk` AS `kode_merk`,`tipe`.`created_at` AS `created_at`,`tipe`.`updated_at` AS `updated_at`,`merk`.`nama_merk` AS `nama_merk` from (`tipe` join `merk` on((`tipe`.`kode_merk` = `merk`.`kode_merk`)))
    */
}
