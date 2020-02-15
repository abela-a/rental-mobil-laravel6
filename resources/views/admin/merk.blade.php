@extends('layouts.master')

@section('title', 'Merk - Abidzar Car Rental')
@section('header', 'Merk')
@section('deskripsi', 'Menampilkan daftar merk mobil.')

@section('button')
<button class="btn btn-primary" data-target="#input" data-toggle="modal"><i class="fas fa-plus fa-fw mr-2"></i>Tambah
  Merk</button>
@endsection

@section('content')
<table class="table table-bordered" id="tolong">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Kode</th>
      <th scope="col">Nama</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($merk as $m)
    <tr>
      <th scope="row" class="first-td">{{ $loop->iteration }}</th>
      <td>{{ $m->kode_merk }}</td>
      <td>{{ $m->nama_merk }}</td>
      <td class="action-td">
        <button class="btn btn-sm btn-info" data-target="#edit-{{ $m->id }}" data-toggle="modal">
          <i class="fas fa-edit fa-fw"></i>
        </button>
        <button class="btn btn-sm btn-danger" data-target="#hapus-{{ $m->id }}" data-toggle="modal">
          <i class="fas fa-trash fa-fw"></i>
        </button>
      </td>
    </tr>

    @modal
    @slot('id_modal') edit-{{ $m->id }} @endslot
    @slot('modal_title', 'Edit Data')
    @slot('modal_submit', 'Edit')

    @slot('form_action')
    {{ route('admin.merk.edit', $m->id) }}
    @endslot

    @csrf @method('patch')
    <div class="form-group">
      <label>Kode Merk</label>
      <input type="text" class="form-control" disabled value="{{ $m->kode_merk }}">
    </div>
    <div class="form-group">
      <label>Nama Merk</label>
      <input type="text" name="nama_merk" class="form-control @error('nama_merk') is-invalid @enderror"
        value="{{ $m->nama_merk }}">
      <div class="invalid-feedback">
        nama merk harus diisi
      </div>
    </div>
    @endmodal

    @modal
    @slot('id_modal') hapus-{{ $m->id }} @endslot
    @slot('modal_title', 'Hapus Data')
    @slot('modal_submit', 'Hapus')

    @slot('form_action')
    {{ route('admin.merk.hapus', $m->id) }}
    @endslot

    @csrf @method('delete')
    <h5 class="text-center">Apakah Anda yakin akan menghapus data ini?</h5>
    @endmodal

    @endforeach
  </tbody>
</table>

@modal
@slot('id_modal', 'input')
@slot('modal_title', 'Tambah Data')
@slot('modal_submit', 'Simpan')

@slot('form_action')
{{ route('admin.merk.simpan') }}
@endslot

@csrf
<div class="form-group">
  <label>Kode Merk</label>
  <input type="text" name="kode_merk" class="form-control @error('kode_merk') is-invalid @enderror">
  <div class="invalid-feedback">
    kode merk harus diisi
  </div>
</div>
<div class="form-group">
  <label>Nama Merk</label>
  <input type="text" name="nama_merk" class="form-control @error('nama_merk') is-invalid @enderror">
  <div class="invalid-feedback">
    nama merk harus diisi
  </div>
</div>
@endmodal

@endsection