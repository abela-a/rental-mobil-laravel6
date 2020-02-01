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
Route::group(['prefix' => 'admin'], function () {
  // PROFILE
  Route::get('', 'AdminMasterController@index')->name('admin.dashboard');
  Route::get('profile', 'AdminMasterController@profile')->name('admin.profile');
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
});

// KARYAWAN
Route::group(['prefix' => 'karyawan'], function () {
  // PROFILE
  Route::get('', 'KaryawanMasterController@index')->name('karyawan.dashboard');
  Route::get('profile', 'KaryawanMasterController@profile')->name('karyawan.profile');
});

// PELANGGAN
Route::group(['prefix' => 'pelanggan'], function () {
  // PROFILE
  Route::get('', 'PelangganMasterController@index')->name('pelanggan.dashboard');
  Route::get('profile', 'PelangganMasterController@profile')->name('pelanggan.profile');
});
