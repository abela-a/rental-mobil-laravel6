@extends('layouts.master')

@section('title', 'Laporan - Abidzar Car Rental')
@section('header', 'Laporan Sopir')

@section('button')
<button class="btn btn-info" onclick="window.print()"><i class="fas fa-print fa-fw mr-2"></i>Cetak</button>
@endsection

@section('content')
@include('laporan.head')
<h2 class="text-center mb-3 d-none" id="print">Laporan Sopir</h2>
@include('laporan.nav')

<div class="table-responsive">
  <table class="table table-bordered">
    <thead class="thead-light">
      <tr class="text-center">
        <th scope="col">#</th>
        <th scope="col">NIK</th>
        <th scope="col">No SIM</th>
        <th scope="col">Nama</th>
        <th scope="col">JK</th>
        <th scope="col">Nomor Ponsel</th>
        <th scope="col">Alamat</th>
        <th scope="col">Tarif / Hari</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($sopir as $data)
      <tr>
        <th scope="row" class="first-td">{{ $loop->iteration }}</th>
        <td>{{ $data->nik }}</td>
        <td>{{ $data->no_sim}}</td>
        <td>{{ $data->nama_sopir}}</td>
        <td>{{ $data->jenis_kelamin}}</td>
        <td><span class="telp">{{ $data->no_hp}}</span></td>
        <td>{{ $data->alamat}}</td>
        <td>Rp.<span class="uang">{{ $data->tarif_perhari }}</span>,-</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection