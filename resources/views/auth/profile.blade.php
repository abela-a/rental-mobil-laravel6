@extends('layouts.master')

@section('title', 'Profile - Abidzar Car Rental')
@section('header', 'Profile')
@section('deskripsi', 'Menampilkan dan mengubah data diri Anda. ')

@section('button')
<button class="btn btn-primary" data-target="#edit" data-toggle="modal"><i class="fas fa-user-edit fa-fw mr-2"></i>Ubah
  Profile</button>
@endsection

@section('content')
<div class="card mb-3" style="max-width: 1000px;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="{{asset('img/fotouser')}}/{{ Auth::user()->foto }}" class="card-img" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title mb-0">{{ Auth::user()->nama }}</h5>
        <p class="card-text mt-0">{{ Auth::user()->email }}</p>
        <ul class="list-group">
          <li class="list-group-item">
            <i class="fa fa-id-card mr-2"></i>
            {{ Auth::user()->nik }}
          </li>
          <li class=" list-group-item">
            <i class="fas fa-phone mr-2"></i>
            <span class="telp">{{ Auth::user()->no_hp}}</span>
          </li>
          <li class="list-group-item">
            @if (Auth::user()->jenis_kelamin == 'L')
            <i class="fas fa-male fa-fw mr-2"></i>
            Laki-laki
            @else
            <i class="fas fa-female fa-fw mr-2"></i>
            Perempuan
            @endif
          </li>
          <li class="list-group-item">
            <i class="fas fa-map-marker-alt  fa-fw mr-2"></i>
            {{ Auth::user()->alamat }}
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

@modal
@slot('id_modal', 'edit')
@slot('modal_title', 'Edit Data Akun')
@slot('modal_submit', 'Simpan Perubahan')

@slot('form_action')
{{ route('admin.profile.update', Auth::user()->id) }}
@endslot

@csrf @method('patch')
<div class="form-row">
  <div class="form-group col-md-6">
    <label>NIK</label>
    <input type="text" class="form-control" disabled value="{{ Auth::user()->nik }}">
  </div>
  <div class="form-group col-md-6">
    <label>Nama Pelanggan</label>
    <input type="text" class="form-control" disabled value="{{ Auth::user()->nama }}">
  </div>
</div>
<div class="form-group">
  <label>Nomor HP</label>
  <input type="text" name="no_hp" class="telp form-control @error('no_hp') is-invalid @enderror"
    value="{{ Auth::user()->no_hp }}">
  <div class="invalid-feedback">
    nomor hp pelanggan harus diisi
  </div>
</div>
<div class="form-group">
  <label>Alamat</label>
  <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror"
    rows="50">{{ Auth::user()->alamat }}</textarea>
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

@endsection