@extends('layouts.master')

@section('title', 'Laporan - Abidzar Car Rental')
@section('header', 'Laporan')

@section('content')
@include('laporan.nav')

<div class="alert alert-info py-4">
  <h3 class="ml-3">Panduan</h3>
  <ul>
    <li>Silahkan pilih menu di navbar untuk melihat laporan tiap-tiap item.</li>
    <li>Anda dapat mencetak laporan dengan cara menekan tombol <code>CTRL + P</code> pada keyboard Anda.</li>
    <li>Untuk dapat mencetak kwitansi setiap transaksi, Anda dapat ke Menu Transaksi
      dan menekan tombol cetak, kemudian Anda akan diarahkan ke halaman Kwitansi.</li>
  </ul>
</div>
@endsection