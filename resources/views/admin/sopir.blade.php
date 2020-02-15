@extends('layouts.master')

@section('title', 'Sopir - Abidzar Car Rental')
@section('header', 'Sopir')
@section('deskripsi', 'Menampilkan daftar sopir.')

@section('button')
<button class="btn btn-primary" data-target="#input" data-toggle="modal"><i class="fas fa-plus fa-fw mr-2"></i>Tambah
  Sopir</button>
@endsection

@section('content')
<table class="table table-bordered" id="tolong">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">NIK</th>
      <th scope="col">Nama</th>
      <th scope="col">No HP</th>
      <th scope="col">Tarif/Hari</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($sopir as $s)
    <tr>
      <th scope="row" class="first-td">{{ $loop->iteration }}</th>
      <td>{{ $s->nik }}</td>
      <td>
        {{ $s->nama_sopir }}
        @if ($s->status_sopir == 'Sibuk')
        <span class="badge badge-danger">{{ $s->status_sopir }}</span>
        @elseif($s->status_sopir == 'Dipesan')
        <span class="badge badge-warning">{{ $s->status_sopir }}</span>
        @else
        <span class="badge badge-success">{{ $s->status_sopir }}</span>
        @endif
      </td>
      <td><span class="telp">{{ $s->no_hp }}</span></td>
      <td>Rp. <span class="uang">{{ $s->tarif_perhari }}</span>,-</td>
      <td class="action-td-details">
        <button class="btn btn-sm btn-secondary" data-target="#detail-{{ $s->id }}" data-toggle="modal">
          <i class="fas fa-list fa-fw"></i>
        </button>
        <button class="btn btn-sm btn-info" data-target="#edit-{{ $s->id }}" data-toggle="modal">
          <i class="fas fa-edit fa-fw"></i>
        </button>
        <button class="btn btn-sm btn-danger" data-target="#hapus-{{ $s->id }}" data-toggle="modal">
          <i class="fas fa-trash fa-fw"></i>
        </button>
      </td>
    </tr>

    @modal
    @slot('id_modal') edit-{{ $s->id }} @endslot
    @slot('modal_title', 'Edit Data')
    @slot('modal_submit', 'Edit')

    @slot('form_action')
    {{ route('admin.sopir.edit', $s->id) }}
    @endslot

    @csrf @method('patch')
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>NIK</label>
        <input type="text" value="{{ $s->nik }}" class="form-control" disabled>
      </div>
      <div class="form-group col-md-6">
        <label>Nama Sopir</label>
        <input type="text" value="{{ $s->nama_sopir }}" class="form-control" disabled>
      </div>
    </div>
    <div class="form-group">
      <label>Nomor HP</label>
      <input type="text" name="no_hp" class="telp form-control @error('no_hp') is-invalid @enderror"
        value="{{ $s->no_hp }}">
      <div class="invalid-feedback">
        nomor hp harus diisi
      </div>
    </div>
    <div class="form-group">
      <label>Alamat</label>
      <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror"
        rows="50">{{ $s->alamat }}</textarea>
      <div class="invalid-feedback">
        alamat harus diisi
      </div>
    </div>
    <div class="form-group">
      <label>Tarif / Hari</label>
      <div class="input-group @error('tarif_perhari') is-invalid @enderror">
        <div class="input-group-prepend">
          <div class="input-group-text">Rp.</div>
        </div>
        <input type="text" name="tarif_perhari" class="form-control uang @error('tarif_perhari') is-invalid @enderror"
          value="{{ $s->tarif_perhari }}">
      </div>
      <div class="invalid-feedback">
        tarif / hari harus diisi
      </div>
    </div>
    @endmodal

    @modal
    @slot('id_modal') hapus-{{ $s->id }} @endslot
    @slot('modal_title', 'Hapus Data')
    @slot('modal_submit', 'Hapus')

    @slot('form_action')
    {{ route('admin.sopir.hapus', $s->id) }}
    @endslot

    @csrf @method('delete')
    <h5 class="text-center">Apakah Anda yakin akan menghapus data ini?</h5>
    @endmodal

    @modal
    @slot('id_modal') detail-{{ $s->id }} @endslot
    @slot('modal_title', 'Detail Data')

    <div class="form-row">
      <div class="form-group col-md-6">
        <label>NIK</label>
        <input type="text" class="form-control" disabled value="{{ $s->nik }}">
      </div>
      <div class="form-group col-md-6">
        <label>No SIM</label>
        <input type="text" class="form-control" disabled value="{{ $s->no_sim }}">
      </div>
    </div>
    <div class="form-group">
      <label>Nama Sopir</label>
      <input type="text" class="form-control" disabled value="{{ $s->nama_sopir }}">
    </div>
    <div class="form-group">
      <label>Nomor HP</label>
      <input type="text" class="telp form-control" disabled value="{{ $s->no_hp }}">
    </div>
    <div class="form-group">
      <label>Alamat</label>
      <input type="text" class="form-control" disabled value="{{ $s->alamat }}">
    </div>
    <div class="form-group">
      <label>Tarif / Hari</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">Rp.</div>
        </div>
        <input type="text" class="form-control uang" disabled value="{{ $s->tarif_perhari }}">
      </div>
    </div>
    <div class="form-group">
      <label>Jenis Kelamin</label>
      <input type="text" class="form-control" disabled
        value="{{ $s->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'}}">
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
{{ route('admin.sopir.simpan') }}
@endslot

@csrf
<div class="form-group">
  <label>NIK</label>
  <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror">
  <div class="invalid-feedback">
    nik sopir harus diisi
  </div>
</div>
<div class="form-group">
  <label>No SIM</label>
  <input type="text" name="no_sim" class="form-control @error('no_sim') is-invalid @enderror">
  <div class="invalid-feedback">
    sim sopir harus diisi
  </div>
</div>
<div class="form-group">
  <label>Nama Sopir</label>
  <input type="text" name="nama_sopir" class="form-control @error('nama_sopir') is-invalid @enderror">
  <div class="invalid-feedback">
    nama sopir harus diisi
  </div>
</div>
<div class="form-group">
  <label>Nomor HP</label>
  <input type="text" name="no_hp" class="telp form-control @error('no_hp') is-invalid @enderror">
  <div class="invalid-feedback">
    nomor hp harus diisi
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
  <label>Tarif / Hari</label>
  <div class="input-group @error('tarif_perhari') is-invalid @enderror">
    <div class="input-group-prepend">
      <div class="input-group-text">Rp.</div>
    </div>
    <input type="text" name="tarif_perhari" class="form-control uang @error('tarif_perhari') is-invalid @enderror">
  </div>
  <div class="invalid-feedback">
    tarif / hari harus diisi
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
@endmodal

@endsection