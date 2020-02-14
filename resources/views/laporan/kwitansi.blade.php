@extends('layouts.master')

@section('title', 'Laporan - Abidzar Car Rental')
@section('header', 'Laporan Kwitansi')

@section('button')
<button class="btn btn-info" onclick="window.print()"><i class="fas fa-print fa-fw mr-2"></i>Cetak</button>
@endsection

@section('content')
@include('laporan.head-kwitansi')

<table class="table table-sm">
  <tr>
    <!-- BARIS PERTAMA -->
    <td class="border-0">Kode Transaksi</td>
    <td class="border-0" style="width:10px">:</td>
    <td class="border-0 font-weight-normal">
      {{ $kwitansi->no_transaksi }}
    </td>
    <td class="border-0">Tanggal Dikembalikan</td>
    <td class="border-0" style="width:10px">:</td>
    <td class="border-0 font-weight-normal">
      {{ $kwitansi->tanggal_kembali_sebenarnya }}
    </td>
  </tr>
  <!-- BARIS KEDUA -->
  <tr>
    <td>Penyewa</td>
    <td style="width:10px">:</td>
    <td class="font-weight-normal">
      {{ $kwitansi->nama }}
    </td>
    <td>Lama Jatuh Tempo</td>
    <td style="width:10px">:</td>
    <td class="font-weight-normal">
      {{ $kwitansi->lama_denda }} Hari
    </td>
  </tr>
  <!-- BARIS KETIGA -->
  <tr>
    <td>Mobil</td>
    <td style="width:10px">:</td>
    <td class="font-weight-normal">
      {{'[' . $kwitansi->no_plat . '] ' . $kwitansi->nama_merk . ' ' . $kwitansi->nama_tipe }}
    </td>
    <td>Deskripsi Kerusakan</td>
    <td style="width:10px">:</td>
    <td class="font-weight-normal">
      {{ $kwitansi->kerusakan }}
    </td>
  </tr>
  <!-- BARIS KEEMPAT -->
  <tr>
    <td>Sopir</td>
    <td style="width:10px">:</td>
    <td class="font-weight-normal">
      {{ $kwitansi->nama_sopir }}
    </td>
    <td>Biaya Kerusakan</td>
    <td style="width:10px">:</td>
    <td class="font-weight-normal">
      Rp.<span class="uang">{{ $kwitansi->biaya_kerusakan }}</span>,-
    </td>
  </tr>
  <!-- BARIS KELIMA -->
  <tr>
    <td>Tanggal Pesan</td>
    <td style="width:10px">:</td>
    <td class="font-weight-normal">
      {{ $kwitansi->tanggal_pesan }}
    </td>
    <td>Biaya BBM</td>
    <td style="width:10px">:</td>
    <td class="font-weight-normal">
      Rp.<span class="uang">{{ $kwitansi->biaya_bbm }}</span>,-
    </td>
  </tr>
  <!-- BARIS KEENAM -->
  <tr>
    <td>Tanggal Mulai</td>
    <td style="width:10px">:</td>
    <td class="font-weight-normal">
      {{ $kwitansi->tanggal_pinjam }}
    </td>
    <td>Harga Sewa Mobil / Hari</td>
    <td style="width:10px">:</td>
    <td class="font-weight-normal">
      Rp.<span class="uang">{{ $kwitansi->harga_sewa }}</span>,-
    </td>
  </tr>
  <!-- BARIS KETUJUH -->
  <tr>
    <td>Tanggal Kembali</td>
    <td style="width:10px">:</td>
    <td class="font-weight-normal">
      {{ $kwitansi->tanggal_kembali_rencana }}
    </td>
    <td>Tarif Sopir / Hari</td>
    <td style="width:10px">:</td>
    <td class="font-weight-normal">
      Rp.<span class="uang">{{ $kwitansi->tarif_perhari }}</span>,-
    </td>
  </tr>
  <!-- BARIS KEDELAPAN -->
  <tr>
    <td>Lama Rental</td>
    <td style="width:10px">:</td>
    <td class="font-weight-normal">
      {{ $kwitansi->lama_rental }} Hari
    </td>
    <td>Total Bayar</td>
    <td style="width:10px">:</td>
    <td class="font-weight-bold text-danger" style="font-size:20px">
      Rp.<span class="uang">{{ $kwitansi->total_bayar }}</span>,-
    </td>
  </tr>
  <!-- BARIS KESEMBILAN -->
  <tr>
    <td></td>
    <td style="width:10px"></td>
    <td class="font-weight-normal"></td>
    <td>Jumlah Bayar</td>
    <td style="width:10px"></td>
    <td class="font-weight-normal">
      Rp.<span class="uang">{{ $kwitansi->jumlah_bayar }}</span>,-
    </td>
  </tr>
  <!-- BARIS KESEPULUH -->
  <tr>
    <td class="border-0"></td>
    <td style="width:10px" class="border-0"></td>
    <td class="font-weight-normal border-0"> </td>
    <td>Kembalian</td>
    <td style="width:10px"></td>
    <td class="font-weight-normal">
      Rp.<span class="uang">{{ $kwitansi->kembalian }}</span>,-
    </td>
  </tr>
</table>
<div class="d-none" id="print">
  <div class="row justify-content-center mt-4">
    <div class="col text-center">
      <?= date('l, d F Y') ?>
    </div>
  </div>
  <div class="row mt-2">
    <div class="col text-center">
      @if (Auth::user()->role_id === 1 || Auth::user()->role_id === 2)
      {{ $role_name }}
      @else
      Karyawan
      @endif
      <br>
      Abidzar Car Rental
      <br><br>
      <h1>
        @if ($kwitansi->status_transaksi == 'Selesai')
        <span class="badge badge-success my-0">
          <i class="fa fa-check" aria-hidden="true"></i>
          LUNAS
        </span>
        @elseif($kwitansi->status_transaksi == 'Proses' || $kwitansi->status_transaksi == 'Mulai')
        <span class="badge badge-warning my-0">
          <i class="fa fa-info-circle" aria-hidden="true"></i>
          BELUM LUNAS
        </span>
        @else
        <span class="badge badge-danger my-0">
          <i class="fa fa-ban" aria-hidden="true"></i>
          BATAL
        </span>
        @endif
      </h1>
      <br>
      (<b>
        @if (Auth::user()->role_id === 1 || Auth::user()->role_id === 2)
        {{ Auth::user()->nama }}
        @else
        .....................................
        @endif
      </b>)
    </div>
    <div class="col text-center">
    </div>
    <div class="col text-center">
      Penyewa <br> <br><br><br><br><br>
      (<b>{{ $kwitansi->nama }}</b>)
    </div>
  </div>
</div>

@endsection