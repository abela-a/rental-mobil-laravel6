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
