<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::view('/', 'welcome');

// ADMIN
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
  // PROFILE
  Route::get('', 'AdminMasterController@index')->name('admin.dashboard');
  Route::get('profile', 'AdminMasterController@profile')->name('admin.profile');
  Route::patch('profile/{user}', 'AdminMasterController@profile_update')->name('admin.profile.update');
  // MERK
  Route::group(['prefix' => 'merk'], function () {
    Route::get('', 'MerkController@index')->name('admin.merk');
    Route::post('', 'MerkController@store')->name('admin.merk.simpan');
    Route::patch('{merk}', 'MerkController@update')->name('admin.merk.edit');
    Route::delete('{merk}', 'MerkController@destroy')->name('admin.merk.hapus');
  });
  // TIPE
  Route::group(['prefix' => 'tipe'], function () {
    Route::get('', 'TipeController@index')->name('admin.tipe');
    Route::post('', 'TipeController@store')->name('admin.tipe.simpan');
    Route::patch('{tipe}', 'TipeController@update')->name('admin.tipe.edit');
    Route::delete('{tipe}', 'TipeController@destroy')->name('admin.tipe.hapus');
  });
  // MOBIL
  Route::group(['prefix' => 'mobil'], function () {
    Route::get('', 'MobilController@index')->name('admin.mobil');
    Route::get('getTipe/{tipe}', 'MobilController@getTipe');
    Route::post('', 'MobilController@store')->name('admin.mobil.simpan');
    Route::patch('{mobil}', 'MobilController@update')->name('admin.mobil.edit');
    Route::delete('{mobil}', 'MobilController@destroy')->name('admin.mobil.hapus');
  });
  // SOPIR
  Route::group(['prefix' => 'sopir'], function () {
    Route::get('', 'SopirController@index')->name('admin.sopir');
    Route::post('', 'SopirController@store')->name('admin.sopir.simpan');
    Route::patch('{sopir}', 'SopirController@update')->name('admin.sopir.edit');
    Route::delete('{sopir}', 'SopirController@destroy')->name('admin.sopir.hapus');
  });
  // AKUN
  Route::group(['prefix' => 'akun'], function () {
    Route::get('pelanggan', 'AccountController@pelanggan')->name('admin.pelanggan');
    Route::get('karyawan', 'AccountController@karyawan')->name('admin.karyawan');
    Route::get('role', 'AccountController@role')->name('admin.role');
    // AKSI
    Route::post('', 'AccountController@store')->name('admin.akun.simpan');
    Route::patch('{akun}', 'AccountController@update')->name('admin.akun.edit');
    Route::patch('role/{akun}', 'AccountController@role_update')->name('admin.akun.role');
    Route::delete('{akun}', 'AccountController@destroy')->name('admin.akun.hapus');
  });
  // PEMESANAN
  Route::group(['prefix' => 'pemesanan'], function () {
    Route::get('', 'TransaksiController@pemesanan')->name('admin.pemesanan');
    Route::post('', 'TransaksiController@memesan')->name('admin.memesan');
    Route::patch('ambil/{pemesanan}/{mobil}/{sopir}', 'TransaksiController@pemesananAmbil')->name('admin.pemesanan.ambil');
    Route::patch('batal/{pemesanan}/{mobil}/{sopir}', 'TransaksiController@pemesananBatal')->name('admin.pemesanan.batal');
  });
  // TRANSAKSI
  Route::group(['prefix' => 'transaksi'], function () {
    Route::get('', 'TransaksiController@transaksi')->name('admin.transaksi');
    Route::get('selesai/{transaksi}', 'TransaksiController@transaksiSelesaiForm')->name('admin.transaksi.selesai-form');
    Route::patch('selesai/{transaksi}', 'TransaksiController@transaksiSelesai')->name('admin.transaksi.selesai');
  });
  // LAPORAN
  Route::group(['prefix' => 'laporan'], function () {
    Route::get('', 'LaporanController@index')->name('admin.laporan');
    Route::get('transaksi', 'LaporanController@transaksi')->name('admin.laporan.transaksi');
    Route::get('kendaraan', 'LaporanController@kendaraan')->name('admin.laporan.kendaraan');
    Route::get('sopir', 'LaporanController@sopir')->name('admin.laporan.sopir');
    Route::get('karyawan', 'LaporanController@karyawan')->name('admin.laporan.karyawan');
    Route::get('pelanggan', 'LaporanController@pelanggan')->name('admin.laporan.pelanggan');
    Route::get('kwitansi/{kwitansi}', 'LaporanController@kwitansi')->name('admin.laporan.kwitansi');
  });
});

// KARYAWAN
Route::group(['prefix' => 'karyawan', 'middleware' => ['auth', 'karyawan']], function () {
  // PROFILE
  Route::get('', 'KaryawanMasterController@index')->name('karyawan.dashboard');
  Route::get('profile', 'KaryawanMasterController@profile')->name('karyawan.profile');
});

// PELANGGAN
Route::group(['prefix' => 'pelanggan', 'middleware' => ['auth', 'pelanggan']], function () {
  // PROFILE
  Route::get('', 'PelangganMasterController@index')->name('pelanggan.dashboard');
  Route::get('profile', 'PelangganMasterController@profile')->name('pelanggan.profile');
  // LAPORAN
  Route::get('laporan/kwitansi/{no_transaksi}', 'LaporanController@kwitansi')->name('pelanggan.laporan.kwitansi');
});
