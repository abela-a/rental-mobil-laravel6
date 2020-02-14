<?php

namespace App\Http\Controllers;

use App\Sopir;
use App\User;
use App\Mobil;
use App\Transaksi;
use App\ViewMobil;
use App\ViewTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function pemesanan()
    {
        $pelanggan = User::where('role_id', 3)->get();
        $mobil = ViewMobil::where('status_rental', 'Kosong')->get();
        $sopir = Sopir::where('status_sopir', 'Luang')->where('id', '!=', 1)->get();
        $pemesanan = ViewTransaksi::where('status_transaksi', '!=', 'Selesai')
            ->where('status_transaksi', '!=', 'Batal')->get();
        return view('admin.transaksi.pemesanan', compact('pelanggan', 'mobil', 'sopir', 'pemesanan'));
    }
    public function memesan(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'mobil_id' => 'required',
            'sopir_id' => 'required',
            'tanggal_pinjam' => 'required',
            'tanggal_kembali_rencana' => 'required',
            'lama_rental' => 'required',
            'total_bayar' => 'required',
        ]);

        $query_transaksi = Transaksi::latest('no_transaksi')->first();

        if ($query_transaksi) {
            $latestTransaksi = $query_transaksi->no_transaksi;
            $latestTransaksi = ++$latestTransaksi;
        } else {
            $latestTransaksi = "T0000001";
        }

        Transaksi::create([
            'no_transaksi' => $latestTransaksi,
            'user_id' => $request->user_id,
            'mobil_id' => $request->mobil_id,
            'sopir_id' => $request->sopir_id,
            'tanggal_pesan' => date('Y-m-d'),
            'tanggal_pinjam' => Carbon::parse($request->tanggal_pinjam),
            'tanggal_kembali_rencana' => Carbon::parse($request->tanggal_kembali_rencana),
            'lama_rental' => $request->lama_rental,
            'total_bayar' => $request->total_bayar,
            'status_transaksi' => 'Proses'
        ]);

        Mobil::where('id', $request->mobil_id)->update(['status_rental' => 'Dipesan']);
        Sopir::where('id', $request->sopir_id)->update(['status_sopir' => 'Dipesan']);

        return redirect()->back()->with('alert', 'Pesanan berhasil ditambahkan!');
    }
    public function pemesananAmbil(Transaksi $pemesanan, Mobil $mobil, Sopir $sopir)
    {
        Transaksi::where('id', $pemesanan->id)->update(['status_transaksi' => 'Mulai']);
        Mobil::where('id', $mobil->id)->update(['status_rental' => 'Jalan']);
        Sopir::where('id', $sopir->id)->update(['status_sopir' => 'Sibuk']);

        return redirect()->back()->with('alert', 'Data pesanan berhasil diperbaharui, mobil telah diambil!');
    }
    public function pemesananBatal(Transaksi $pemesanan, Mobil $mobil, Sopir $sopir)
    {
        Transaksi::where('id', $pemesanan->id)->update(['status_transaksi' => 'Batal']);
        Mobil::where('id', $mobil->id)->update(['status_rental' => 'Kosong']);
        Sopir::where('id', $sopir->id)->update(['status_sopir' => 'Luang']);

        return redirect()->back()->with('alert', 'Pesanan berhasil dibatalkan!');
    }
    public function transaksi()
    {
        $transaksi = ViewTransaksi::where('status_transaksi', 'Selesai')
            ->orWhere('status_transaksi', 'Batal')->get();
        return view('admin.transaksi.transaksi', compact('transaksi'));
    }
    public function transaksiSelesaiForm(ViewTransaksi $transaksi)
    {
        return view('admin.transaksi.form-selesai', compact('transaksi'));
    }
    public function transaksiSelesai(Request $request, Transaksi $transaksi)
    {
        if (Auth::user()->role_id === 1) {
            $role = 'admin';
        } else {
            $role = 'karyawan';
        }

        Transaksi::where('id', $transaksi->id)->update([
            'tanggal_kembali_sebenarnya' => date('Y-m-d'),
            'lama_denda' => $request->lama_denda,
            'kerusakan' => $request->kerusakan,
            'biaya_bbm' => preg_replace('/\D/', '', $request->biaya_bbm),
            'biaya_kerusakan' => preg_replace('/\D/', '', $request->biaya_kerusakan),
            'biaya_denda' => preg_replace('/\D/', '', $request->denda),
            'jumlah_bayar' => preg_replace('/\D/', '', $request->jumlah_bayar),
            'kembalian' => preg_replace('/\D/', '', $request->kembalian),
            'total_bayar' => preg_replace('/\D/', '', $request->total_bayar),
            'status_transaksi' => 'Selesai'
        ]);

        Mobil::where('id', $request->mobil_id)->update(['status_rental' => 'Kosong']);
        Sopir::where('id', $request->sopir_id)->update(['status_sopir' => 'Luang']);

        return redirect($role . '/transaksi')->with('alert', 'Rental telah selesai!');
    }
}
