<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViewTransaksi extends Model
{
    protected $table = 'view_transaksi';
    /*
    select `transaksi`.`id` AS `id`,`transaksi`.`no_transaksi` AS `no_transaksi`,`transaksi`.`user_id` AS `user_id`,`transaksi`.`mobil_id` AS `mobil_id`,`transaksi`.`sopir_id` AS `sopir_id`,`transaksi`.`tanggal_pesan` AS `tanggal_pesan`,`transaksi`.`tanggal_pinjam` AS `tanggal_pinjam`,`transaksi`.`tanggal_kembali_rencana` AS `tanggal_kembali_rencana`,`transaksi`.`tanggal_kembali_sebenarnya` AS `tanggal_kembali_sebenarnya`,`transaksi`.`lama_rental` AS `lama_rental`,`transaksi`.`lama_denda` AS `lama_denda`,`transaksi`.`kerusakan` AS `kerusakan`,`transaksi`.`biaya_bbm` AS `biaya_bbm`,`transaksi`.`biaya_kerusakan` AS `biaya_kerusakan`,`transaksi`.`biaya_denda` AS `biaya_denda`,`transaksi`.`total_bayar` AS `total_bayar`,`transaksi`.`jumlah_bayar` AS `jumlah_bayar`,`transaksi`.`kembalian` AS `kembalian`,`transaksi`.`status_transaksi` AS `status_transaksi`,`transaksi`.`created_at` AS `created_at`,`transaksi`.`updated_at` AS `updated_at`,`users`.`nama` AS `nama`,`users`.`foto` AS `foto`,`sopir`.`nama_sopir` AS `nama_sopir`,`sopir`.`tarif_perhari` AS `tarif_perhari`,`view_mobil`.`no_plat` AS `no_plat`,`view_mobil`.`nama_merk` AS `nama_merk`,`view_mobil`.`nama_tipe` AS `nama_tipe`,`view_mobil`.`harga_sewa` AS `harga_sewa` from (((`transaksi` join `view_mobil` on((`transaksi`.`mobil_id` = `view_mobil`.`id`))) join `users` on((`transaksi`.`user_id` = `users`.`id`))) join `sopir` on((`transaksi`.`sopir_id` = `sopir`.`id`)))
    */
    protected $dates = ['tanggal_pesan', 'tanggal_pinjam', 'tanggal_kembali_rencana', 'tanggal_kembali_sebenarnya'];
}
