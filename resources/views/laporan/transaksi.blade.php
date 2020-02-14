@extends('layouts.master')

@section('title', 'Laporan - Abidzar Car Rental')
@section('header', 'Laporan Transaksi')

@section('button')
<button class="btn btn-info" onclick="window.print()"><i class="fas fa-print fa-fw mr-2"></i>Cetak</button>
@endsection

@section('content')
@include('laporan.head')
<h2 class="text-center mb-3 d-none" id="print">Laporan Transaksi</h2>
@include('laporan.nav')

<div class="table-responsive">
  <table class="table table-bordered">
    <thead class="thead-light">
      <tr class="text-center">
        <th scope="col" rowspan="2">#</th>
        <th scope="col" rowspan="2">Kode</th>
        <th scope="col" rowspan="2">Nama</th>
        <th scope="col" colspan="3">Biaya</th>
        <th scope="col" colspan="2">Tarif</th>
        <th scope="col" rowspan="2">Total</th>
      </tr>
      <tr class="text-center">
        <th scope="col">Kerusakan</th>
        <th scope="col">BBM</th>
        <th scope="col">Jatuh Tempo</th>
        <th scope="col">Sopir</th>
        <th scope="col">Sewa</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($transaksi as $data)
      <tr>
        <th scope="row" class="first-td">{{ $loop->iteration }}</th>
        <td>{{ $data->no_transaksi }}</td>
        <td>{{ $data->nama }}</td>
        <td>Rp.<span class="uang">{{ $data->biaya_kerusakan }}</span>,-</td>
        <td>Rp.<span class="uang">{{ $data->biaya_bbm }}</span>,-</td>
        <td>Rp.<span class="uang">{{ $data->biaya_denda }}</span>,-</td>
        <td>Rp.<span class="uang">{{ $data->tarif_perhari }}</span>,-</td>
        <td>Rp.<span class="uang">{{ $data->harga_sewa }}</span>,-</td>
        <td>Rp.<span class="uang">{{ $data->total_bayar }}</span>,-</td>
      </tr>
      @endforeach
    </tbody>
    <tfoot class="bg-light">
      <tr class="text-danger font-weight-bolder">
        <td colspan="7"></td>
        <td>Total</td>
        <td>Rp.<span class="uang">{{ $total }}</span>,-</td>
      </tr>
    </tfoot>
  </table>
</div>

@endsection