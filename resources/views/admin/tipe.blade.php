@extends('layouts.master')

@section('title', 'Tipe - Abidzar Car Rental')
@section('header', 'Tipe')
@section('deskripsi', 'Menampilkan daftar tipe mobil.')

@section('button')
<button class="btn btn-primary" data-target="#input" data-toggle="modal"><i class="fas fa-plus fa-fw mr-2"></i>Tambah
  Tipe</button>
@endsection

@section('content')
<table class="table table-bordered" id="tolong">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Kode</th>
      <th scope="col">Tipe</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($tipe as $t)
    <tr>
      <th scope="row" class="first-td">{{ $loop->iteration }}</th>
      <td>{{ $t->kode_tipe }}</td>
      <td>{{ $t->nama_tipe }} <code class="text-muted">|{{ $t->nama_merk }}</code></td>
      <td class="action-td">
        <button class="btn btn-sm btn-info" data-target="#edit-{{ $t->id }}" data-toggle="modal">
          <i class="fas fa-edit fa-fw"></i>
        </button>
        <button class="btn btn-sm btn-danger" data-target="#hapus-{{ $t->id }}" data-toggle="modal">
          <i class="fas fa-trash fa-fw"></i>
        </button>
      </td>
    </tr>

    @modal
    @slot('id_modal') edit-{{ $t->id }} @endslot
    @slot('modal_title', 'Edit Data')
    @slot('modal_submit', 'Edit')

    @slot('form_action')
    {{ route('admin.tipe.edit', $t->id) }}
    @endslot

    @csrf @method('patch')
    <div class="form-group">
      <label>Merk</label>
      <input type="text" class="form-control" disabled value="{{ $t->nama_merk }}">
    </div>
    <div class="form-group">
      <label>Kode Tipe</label>
      <input type="text" class="form-control" disabled value="{{ $t->kode_tipe }}">
    </div>
    <div class="form-group">
      <label>Nama Tipe</label>
      <input type="text" name="nama_tipe" class="form-control @error('nama_tipe') is-invalid @enderror"
        value="{{ $t->nama_tipe }}">
      <div class="invalid-feedback">
        nama tipe harus diisi
      </div>
    </div>
    @endmodal

    @modal
    @slot('id_modal') hapus-{{ $t->id }} @endslot
    @slot('modal_title', 'Hapus Data')
    @slot('modal_submit', 'Hapus')

    @slot('form_action')
    {{ route('admin.tipe.hapus', $t->id) }}
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
{{ route('admin.tipe.simpan') }}
@endslot

@csrf
<div class="form-group">
  <label>Merk</label>
  <select name="kode_merk" class="form-control @error('kode_tipe') is-invalid @enderror">
    <option disabled selected>Pilih Merk</option>
    @foreach ($merk as $m)
    <option value="{{ $m->kode_merk }}">{{ $m->nama_merk }}</option>
    @endforeach
  </select>
  <div class="invalid-feedback">
    merk harus dipilih
  </div>
</div>
<div class="form-group">
  <label>Kode Tipe</label>
  <input type="text" name="kode_tipe" class="form-control @error('kode_tipe') is-invalid @enderror">
  <div class="invalid-feedback">
    kode tipe harus diisi
  </div>
</div>
<div class="form-group">
  <label>Nama Tipe</label>
  <input type="text" name="nama_tipe" class="form-control @error('nama_tipe') is-invalid @enderror">
  <div class="invalid-feedback">
    nama tipe harus diisi
  </div>
</div>
@endmodal

@endsection