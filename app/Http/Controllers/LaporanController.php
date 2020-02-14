<?php

namespace App\Http\Controllers;

use App\Sopir;
use App\User;
use App\ViewMobil;
use App\ViewTransaksi;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.laporan');
    }
    public function transaksi()
    {
        $total = ViewTransaksi::where('status_transaksi', 'Selesai')->sum('total_bayar');
        $transaksi = ViewTransaksi::where('status_transaksi', 'Selesai')->get();
        return view('laporan.transaksi', compact('transaksi', 'total'));
    }
    public function kendaraan()
    {
        $kendaraan = ViewMobil::all();
        return view('laporan.kendaraan', compact('kendaraan'));
    }
    public function sopir()
    {
        $sopir = Sopir::where('id', '!=', 1)->get();
        return view('laporan.sopir', compact('sopir'));
    }
    public function karyawan()
    {
        $user = User::where('role_id', 2)->get();
        return view('laporan.karyawan', compact('user'));
    }
    public function pelanggan()
    {
        $user = User::where('role_id', 3)->get();
        return view('laporan.pelanggan', compact('user'));
    }
    public function kwitansi(ViewTransaksi $kwitansi)
    {
        return view('laporan.kwitansi', compact('kwitansi'));
    }
}
