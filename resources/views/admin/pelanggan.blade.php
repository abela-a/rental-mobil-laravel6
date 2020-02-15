@extends('layouts.master')

@section('title', 'Pelanggan - Abidzar Car Rental')
@section('header', 'Pelanggan')
@section('deskripsi', 'Menampilkan daftar pelanggan.')

@section('button')
<button class="btn btn-primary" data-target="#input" data-toggle="modal"><i class="fas fa-plus fa-fw mr-2"></i>Tambah
  Pelanggan</button>
@endsection

@section('content')
<table class="table table-bordered" id="tolong">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">NIK</th>
      <th scope="col">Nama</th>
      <th scope="col">Nomor HP</th>
      <th scope="col">Email</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $user)
    <tr>
      <th scope="row" class="first-td">{{ $loop->iteration }}</th>
      <td>{{ $user->nik }}</td>
      <td>
        <img src="{{ asset('img/fotouser') }}/{{ $user->foto }}" height="50px" class="border rounded mr-2">
        {{ $user->nama }}
      </td>
      <td><span class="telp">{{ $user->no_hp }}</span></td>
      <td>{{ $user->email }}</td>
      <td class="action-td-details">
        <button class="btn btn-sm btn-secondary" data-target="#detail-{{ $user->id }}" data-toggle="modal">
          <i class="fas fa-list fa-fw"></i>
        </button>
        <button class="btn btn-sm btn-info" data-target="#edit-{{ $user->id }}" data-toggle="modal">
          <i class="fas fa-edit fa-fw"></i>
        </button>
        <button class="btn btn-sm btn-danger" data-target="#hapus-{{ $user->id }}" data-toggle="modal">
          <i class="fas fa-trash fa-fw"></i>
        </button>
      </td>
    </tr>

    @modal
    @slot('id_modal') edit-{{ $user->id }} @endslot
    @slot('modal_title', 'Edit Data')
    @slot('modal_submit', 'Edit')

    @slot('form_action')
    {{ route('admin.akun.edit', $user->id) }}
    @endslot

    @csrf @method('patch')
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>NIK</label>
        <input type="text" class="form-control" disabled value="{{ $user->nik }}">
      </div>
      <div class="form-group col-md-6">
        <label>Nama Pelanggan</label>
        <input type="text" class="form-control" disabled value="{{ $user->nama }}">
      </div>
    </div>
    <div class="form-group">
      <label>Nomor HP</label>
      <input type="text" name="no_hp" class="telp form-control @error('no_hp') is-invalid @enderror"
        value="{{ $user->no_hp }}">
      <div class="invalid-feedback">
        nomor hp pelanggan harus diisi
      </div>
    </div>
    <div class="form-group">
      <label>Alamat</label>
      <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror"
        rows="50">{{ $user->alamat }}</textarea>
      <div class="invalid-feedback">
        alamat harus diisi
      </div>
    </div>
    <div class="form-group">
      <label>Foto</label>
      <div class="custom-file">
        <input type="file" class="custom-file-input @error('foto') is-invalid @enderror" name="foto">
        <label class="custom-file-label">Pilih Gambar</label>
      </div>
      <div class="invalid-feedback">
        foto harus valid
      </div>
    </div>
    <div class="form-group">
      <label>Password</label>
      <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
      <small class="text-muted">Kosongkan jika tidak ingin mengubah.</small>
      <div class="invalid-feedback">
        password minimal 8 karakter
      </div>
    </div>
    @endmodal

    @modal
    @slot('id_modal') hapus-{{ $user->id }} @endslot
    @slot('modal_title', 'Hapus Data')
    @slot('modal_submit', 'Hapus')

    @slot('form_action')
    {{ route('admin.akun.hapus', $user->id) }}
    @endslot

    @csrf @method('delete')
    <h5 class="text-center">Apakah Anda yakin akan menghapus data ini?</h5>
    @endmodal

    @modal
    @slot('id_modal') detail-{{ $user->id }} @endslot
    @slot('modal_title', 'Detail Data')
    <div class="form-group">
      <label>Nama Pelanggan</label>
      <input type="text" class="form-control" disabled value="{{ $user->nama }}">
    </div>
    <div class="form-group">
      <label>NIK</label>
      <input type="text" class="form-control" disabled value="{{ $user->nik }}">
    </div>
    <div class="form-group">
      <label>Email</label>
      <input type="email" class="form-control" disabled value="{{ $user->email }}">
    </div>
    <div class="form-group">
      <label>Nomor HP</label>
      <input type="text" class="telp form-control" disabled value="{{ $user->no_hp }}">
    </div>
    <div class="form-group">
      <label>Alamat</label>
      <input type="text" class="form-control" disabled value="{{ $user->alamat }}">
    </div>
    <div class="form-group">
      <label>Jenis Kelamin</label>
      <input type="text" class="form-control" disabled
        value="{{ $user->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'}}">
    </div>
    @endmodal

    @endforeach
  </tbody>
</table>

@modal
@slot('id_modal', 'input')
@slot('modal_title', 'Tambah Data')
@slot('modal_submit', 'Simpan')

@slot('form_action')
{{ route('admin.akun.simpan') }}
@endslot

@csrf
<input type="hidden" name="_role" value="3">

<div class="form-group">
  <label>Nama Pelanggan</label>
  <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror">
  <div class="invalid-feedback">
    nama pelanggan harus diisi
  </div>
</div>
<div class="form-group">
  <label>NIK</label>
  <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror">
  <div class="invalid-feedback">
    nik pelanggan harus diisi
  </div>
</div>
<div class="form-group">
  <label>Email</label>
  <input type="email" name="email" class="form-control @error('email') is-invalid @enderror">
  <div class="invalid-feedback">
    email pelanggan harus diisi
  </div>
</div>
<div class="form-group">
  <label>Nomor HP</label>
  <input type="text" name="no_hp" class="telp form-control @error('no_hp') is-invalid @enderror">
  <div class="invalid-feedback">
    nomor hp pelanggan harus diisi
  </div>
</div>
<div class="form-group">
  <label>Alamat</label>
  <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="50"></textarea>
  <div class="invalid-feedback">
    alamat harus diisi
  </div>
</div>
<div class="form-group">
  <label>Jenis Kelamin</label>
  <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
    <option disabled selected>Pilih Jenis Kelamin</option>
    <option value="L">Laki-laki</option>
    <option value="P">Perempuan</option>
  </select>
  <div class="invalid-feedback">
    jenis kelamin harus dipilih
  </div>
</div>
<div class="form-group">
  <label>Foto</label>
  <div class="custom-file">
    <input type="file" class="custom-file-input @error('foto') is-invalid @enderror" name="foto">
    <label class="custom-file-label">Pilih Gambar</label>
  </div>
  <div class="invalid-feedback">
    foto harus valid
  </div>
</div>
<div class="form-group">
  <label>Password</label>
  <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
  <div class="invalid-feedback">
    password minimal 8 karakter
  </div>
</div>

@endmodal

@endsection