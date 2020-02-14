<?php

namespace App\Http\Controllers;

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
    public function kwitansi(ViewTransaksi $no_transaksi)
    {
        return view('laporan.kwitansi', compact('no_transaksi'));
    }
}
