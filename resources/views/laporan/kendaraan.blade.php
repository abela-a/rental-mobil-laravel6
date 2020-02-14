@extends('layouts.master')

@section('title', 'Laporan - Abidzar Car Rental')
@section('header', 'Laporan Kendaraan')

@section('button')
<button class="btn btn-info" onclick="window.print()"><i class="fas fa-print fa-fw mr-2"></i>Cetak</button>
@endsection

@section('content')
@include('laporan.head')
<h2 class="text-center mb-3 d-none" id="print">Laporan Kendaraan</h2>
@include('laporan.nav')

<div class="table-responsive">
  <table class="table table-bordered">
    <thead class="thead-light">
      <tr class="text-center">
        <th scope="col">#</th>
        <th scope="col">Nomor Polisi</th>
        <th scope="col">Mobil</th>
        <th scope="col">Kode Merk</th>
        <th scope="col">Kode Tipe</th>
        <th scope="col">Harga Sewa / Hari</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($kendaraan as $data)
      <tr>
        <th scope="row" class="first-td">{{ $loop->iteration }}</th>
        <td>{{ $data->no_plat }}</td>
        <td>{{ $data->nama_merk . ' ' .  $data->nama_tipe}}</td>
        <td>{{ $data->kode_merk}}</td>
        <td>{{ $data->kode_tipe}}</td>
        <td>Rp.<span class="uang">{{ $data->harga_sewa }}</span>,-</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection