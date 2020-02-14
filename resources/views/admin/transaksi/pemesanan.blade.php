@extends('layouts.master')

@section('title', 'Pemesanan - Abidzar Car Rental')
@section('header', 'Pemesanan')
@section('deskripsi', 'Menampilkan daftar pesanan mobil untuk pelanggan.')

@section('style')
<link rel="stylesheet" href="{{ asset('vendor/datepicker/datepicker.min.css') }}">
@endsection

@section('button')
<button class="btn btn-primary" data-target="#input" data-toggle="modal"><i class="fas fa-plus fa-fw"></i></button>
@endsection

@section('content')
<table class="table table-bordered" id="tolong">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Kode</th>
      <th scope="col">Penyewa</th>
      <th scope="col">Mobil</th>
      <th scope="col">Tanggal Mulai</th>
      <th scope="col">Lama Rental</th>
      <th scope="col">Total Biaya</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($pemesanan as $data)
    <tr>
      <th scope="row" class="first-td">{{ $loop->iteration }}</th>
      <td>{{ $data->no_transaksi }}</td>
      <td>{{ $data->nama }}</td>
      <td>{!! $data->no_plat . '<br> ' . $data->nama_merk . '<br>' .$data->nama_tipe !!}</td>
      <td>{{ $data->tanggal_pesan->format('d/m/Y') }}</td>
      <td>{{ $data->lama_rental }} Hari</td>
      <td>Rp. <span class="uang">{{ $data->total_bayar }}</span>,-</td>
      <td class="action-td">
        @if ($data->status_transaksi != 'Mulai')
        {{-- TOMBOL AMBIL --}}
        <button data-toggle="modal" data-target="#ambil-{{ $data->id }}" class="mb-1 btn btn-sm btn-primary text-white">
          <i class=" fa fa-car fa-fw" aria-hidden="true"></i> Ambil
        </button>
        @else
        {{-- TOMBOL SELESAI --}}
        <a href="{{ route('admin.transaksi.selesai-form', $data->id) }}">
          <button class="mb-1 btn btn-sm btn-success text-white">
            <i class=" fa fa-check fa-fw" aria-hidden="true"></i> Selesai
          </button>
        </a>
        @endif
        {{-- TOMBOL PILIHAN --}}
        <button type="button" class="mb-1 dropdown btn btn-secondary btn-sm" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false">
          <i class="fa fa-bars fa-fw" aria-hidden="true"></i> Pilihan
        </button>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="{{ route($role.'.laporan.kwitansi', $data->id) }}">Cetak</a>

          <button class="dropdown-item {{ $data->status_transaksi != 'Proses' ? 'disabled' : '' }}" data-toggle="modal"
            data-target="#batal-{{ $data->id }}">Batalkan</button>
        </div>
      </td>
    </tr>

    @modal
    @slot('id_modal')
    ambil-{{$data->id}}
    @endslot
    @slot('modal_title', 'Konfirmasi Pesanan')
    @slot('modal_submit', 'Konfirmasi')

    @slot('form_action')
    {{ route('admin.pemesanan.ambil', [$data->id, $data->mobil_id, $data->sopir_id]) }}
    @endslot

    @csrf @method('patch')
    <ul class="list-group list-group-flush">

      <div class="row list-group-item">
        <div class="col">No Transaksi</div>
        <div class="col" style="font-weight:500">{{ $data->no_transaksi }}</div>
      </div>

      <div class="row list-group-item">
        <div class="col">Nama Pemesan</div>
        <div class="col" style="font-weight:500">{{ $data->nama }}</div>
      </div>

      <div class="row list-group-item">
        <div class="col">Mobil</div>
        <div class="col" style="font-weight:500">
          {{ $data->no_plat .' - '. $data->nama_merk .' '. $data->nama_tipe }}
        </div>
      </div>

      <div class="row list-group-item">
        <div class="col">Sopir</div>
        <div class="col" style="font-weight:500">
          {{ $data->nama_sopir }}
        </div>
      </div>

      <div class="row list-group-item">
        <div class="col">Tanggal Pesan</div>
        <div class="col" style="font-weight:500">
          {{ $data->tanggal_pesan->format('d F Y') }}
        </div>
      </div>

      <div class="row list-group-item">
        <div class="col">Tanggal Mulai</div>
        <div class="col" style="font-weight:500">
          {{ $data->tanggal_pinjam->format('d F Y') }}
        </div>
      </div>

      <div class="row list-group-item">
        <div class="col">Tanggal Rencana Pengembalian</div>
        <div class="col" style="font-weight:500">
          {{ $data->tanggal_kembali_rencana->format('d F Y') }}
        </div>
      </div>

      <div class="row list-group-item">
        <div class="col">Lama Rental</div>
        <div class="col" style="font-weight:500">
          {{ $data->lama_rental }} Hari
        </div>
      </div>

      <div class="row list-group-item">
        <div class="col">Tarif Sopir / Hari</div>
        <div class="col" style="font-weight:500">
          Rp. <span class="uang">{{ $data->tarif_perhari }}</span>,-
        </div>
      </div>

      <div class="row list-group-item">
        <div class="col">Harga Sewa Mobil / Hari</div>
        <div class="col" style="font-weight:500">
          Rp. <span class="uang">{{ $data->harga_sewa }}</span>,-
        </div>
      </div>

      <div class="row list-group-item">
        <div class="col">Total Bayar Sementara</div>
        <div class="col" style="font-weight:500">
          Rp. <span class="uang">{{ $data->total_bayar }}</span>,-
        </div>
      </div>
    </ul>

    @endmodal

    @modal
    @slot('id_modal')
    batal-{{$data->id}}
    @endslot
    @slot('modal_title', 'Batalkan Pesanan')
    @slot('modal_submit', 'Batalkan')

    @slot('form_action')
    {{ route('admin.pemesanan.batal', [$data->id, $data->mobil_id, $data->sopir_id]) }}
    @endslot

    @csrf @method('patch')

    <ul class="list-group list-group-flush">
      <div class="row list-group-item">
        <div class="col">No Transaksi</div>
        <div class="col" style="font-weight:500">{{ $data->no_transaksi }}</div>
      </div>

      <div class="row list-group-item">
        <div class="col">Nama Pemesan</div>
        <div class="col" style="font-weight:500">{{ $data->nama }}</div>
      </div>

      <div class="row list-group-item">
        <div class="col">Mobil</div>
        <div class="col" style="font-weight:500">
          {{ $data->no_plat .' - '. $data->nama_merk .' '. $data->nama_tipe }}
        </div>
      </div>
      <div class="row list-group-item">
        <div class="col">Tanggal Pesan</div>
        <div class="col" style="font-weight:500">
          {{ $data->tanggal_pesan->format('d F Y') }}
        </div>
      </div>
    </ul>
    @endmodal

    @endforeach
  </tbody>
</table>

@modal
@slot('id_modal', 'input')
@slot('modal_title', 'Tambah Pesanan')
@slot('modal_submit', 'Simpan')

@slot('form_action')
{{ route('admin.memesan') }}
@endslot

@csrf
<div class="form-group">
  <label>Penyewa</label>
  <select class="browser-default custom-select" name="user_id">
    <option value="" selected disabled>Pilih Pelanggan</option>
    @foreach ($pelanggan as $pl)
    <option value="{{ $pl->id }}">{{ $pl->nama }}</option>
    @endforeach
  </select>
</div>

<div class="form-group">
  <label>Mobil</label>
  <select class="browser-default custom-select" name="mobil_id" id="mobil-id">
    <option value="" selected disabled>Pilih Mobil</option>
    @foreach ($mobil as $m)
    <option value="{{ $m->id }}" harga="{{ $m->harga_sewa }}">
      {{ $m->no_plat .' - '. $m->nama_merk .' '. $m->nama_tipe }}
    </option>
    @endforeach
  </select>
</div>

<div class="form-group" id="harga-sewa-rental">
  <label>Harga Sewa / Hari</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">Rp.</span>
    </div>
    <input type="text" class="uang form-control" id="harga-sewa" disabled>
  </div>
</div>

<div class="form-group">
  <label>Tanggal Mulai Rental</label>
  <input type="text" class="form-control datepicker" id="tanggal-pinjam" name="tanggal_pinjam" readonly>
</div>

<div class="form-group">
  <label>Tanggal Selesai Rental</label>
  <input type="text" class="form-control datepicker" id="tanggal-kembali-rencana" name="tanggal_kembali_rencana"
    readonly>
</div>

<div class="form-group">
  <label>Lama Rental</label>
  <div class="input-group" style="width:100px">
    <input type="text" class="form-control" id="lama-rental" name="lama_rental" readonly>
    <div class="input-group-append">
      <span class="input-group-text">Hari</span>
    </div>
  </div>
</div>

<div class="form-group">
  <div class="custom-control custom-switch mb-3">
    <input type="checkbox" class="custom-control-input" id="sopir-check">
    <label class="custom-control-label" for="sopir-check">Sopir</label>
  </div>
  <div id="show-sopir" class="d-none">
    <div class="form-group">
      <select class="browser-default custom-select" name="sopir_id" id="sopir-id">
        <option value="1" harga="0">Pilih Sopir</option>
        @foreach ($sopir as $s)
        <option value="{{ $s->id }}" harga="{{ $s->tarif_perhari }}"> {{ $s->nama_sopir }} </option>
        @endforeach
      </select>
    </div>

    <div class="form-group" id="tarif-sopir">
      <label for="tarif_perhari">Tarif Sopir / Hari</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Rp.</span>
        </div>
        <input type="text" class="form-control" id="tarif-perhari" name="tarif_perhari" readonly value="0">
      </div>
    </div>
  </div>
</div>

<div class="form-group card border-primary p-3 text-white mt-4">
  <label class="text-primary">Total Bayar Sementara</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">Rp.</span>
    </div>
    <input type="text" class="form-control" id="total-bayar" name="total_bayar" readonly>
  </div>
</div>
@endmodal

@endsection

@section('script')
<script src="{{ asset('vendor/datepicker/datepicker.min.js') }}"></script>
<script>
  $(document).ready(function(){
    $('.datepicker').datepicker({
      autoclose:true,
      todayHighlight:true,
      startDate: '+0d',
      format: 'd MM yyyy'
    })
  })
</script>
@endsection