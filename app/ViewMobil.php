<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViewMobil extends Model
{
    protected $table = 'view_mobil';
    /*
    select `mobil`.`id` AS `id`,`mobil`.`no_plat` AS `no_plat`,`mobil`.`kode_merk` AS `kode_merk`,`merk`.`nama_merk` AS `nama_merk`,`mobil`.`kode_tipe` AS `kode_tipe`,`tipe`.`nama_tipe` AS `nama_tipe`,`mobil`.`harga_sewa` AS `harga_sewa`,`mobil`.`foto_mobil` AS `foto_mobil`,`mobil`.`jenis_mobil` AS `jenis_mobil`,`mobil`.`transmisi` AS `transmisi`,`mobil`.`status_rental` AS `status_rental`,`mobil`.`created_at` AS `created_at`,`mobil`.`updated_at` AS `updated_at` from ((`mobil` join `tipe` on((`mobil`.`kode_tipe` = `tipe`.`kode_tipe`))) join `merk` on((`mobil`.`kode_merk` = `merk`.`kode_merk`)))
    */
}
