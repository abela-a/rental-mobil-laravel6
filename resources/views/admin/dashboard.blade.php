@extends('layouts.master')

@section('title', 'Dashboard - Abidzar Car Rental')
@section('header', 'Dashboard')

@section('content')
<div class="row">
  <div class="col-4 mb-4">
    <div class="card">
      <div class="card-body">
        <span class="bg-primary p-2 rounded mr-2"><i class="fas fa-car fa-fw text-white"></i></span>
        <h3 class="font-weight-bolder d-inline">12</h3> mobil
      </div>
    </div>
  </div>
  <div class="col-4 mb-4">
    <div class="card">
      <div class="card-body">
        <span class="bg-primary p-2 rounded mr-2"><i class="fas fa-user-tie fa-fw text-white"></i></span>
        <h3 class="font-weight-bolder d-inline">12</h3> karyawan
      </div>
    </div>
  </div>
  <div class="col-4 mb-4">
    <div class="card">
      <div class="card-body">
        <span class="bg-primary p-2 rounded mr-2"><i class="fas fa-user fa-fw text-white"></i></span>
        <h3 class="font-weight-bolder d-inline">12</h3> pelanggan
      </div>
    </div>
  </div>
  <div class="col-4 mb-4">
    <div class="card">
      <div class="card-body">
        <span class="bg-primary p-2 rounded mr-2"><i class="fas fa-map-marker-alt fa-fw text-white"></i></span>
        <h3 class="font-weight-bolder d-inline">12</h3> sopir
      </div>
    </div>
  </div>
  <div class="col-4 mb-4">
    <div class="card">
      <div class="card-body">
        <span class="bg-primary p-2 rounded mr-2"><i class="fas fa-list fa-fw text-white"></i></span>
        <h3 class="font-weight-bolder d-inline">12</h3> pemesanan
      </div>
    </div>
  </div>
  <div class="col-4 mb-4">
    <div class="card">
      <div class="card-body">
        <span class="bg-primary p-2 rounded mr-2"><i class="fas fa-dollar-sign fa-fw text-white"></i></span>
        <h3 class="font-weight-bolder d-inline">12</h3> transaksi
      </div>
    </div>
  </div>
</div>
@endsection