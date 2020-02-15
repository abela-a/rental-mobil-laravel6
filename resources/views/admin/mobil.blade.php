@extends('layouts.master')

@section('title', 'Mobil - Abidzar Car Rental')
@section('header', 'Mobil')
@section('deskripsi', 'Menampilkan daftar mobil.')

@section('button')
<button class="btn btn-primary" data-target="#input" data-toggle="modal"><i class="fas fa-plus fa-fw mr-2"></i>Tambah
  Mobil</button>
@endsection

@section('content')
<table class="table table-bordered" id="tolong">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">No Plat</th>
      <th scope="col" colspan="2">Mobil</th>
      <th scope="col">Informasi</th>
      <th scope="col">Sewa/Hari</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($mobil as $m)
    <tr>
      <th scope="row" class="first-td">{{ $loop->iteration }}</th>
      <td>{{ $m->no_plat }}</td>
      <td><img src="{{ asset('img/fotomobil') }}/{{ $m->foto_mobil }}" width="150px"></td>
      <td>{{ $m->nama_merk }} {{ $m->nama_tipe }}</td>
      <td>
        @if ($m->status_rental == 'Jalan')
        <span class="badge badge-danger">{{ $m->status_rental }}</span>
        @elseif($m->status_rental == 'Dipesan')
        <span class="badge badge-warning">{{ $m->status_rental }}</span>
        @else
        <span class="badge badge-success">{{ $m->status_rental }}</span>
        @endif
        <span class="badge badge-primary">{{ $m->transmisi }}</span>
        <span class="badge badge-info">{{ $m->jenis_mobil }}</span>
      </td>
      <td>Rp.<span class="uang">{{ $m->harga_sewa }}</span>,-</td>
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
    {{ route('admin.mobil.edit', $m->id) }}
    @endslot

    @csrf @method('patch')
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>No Plat</label>
        <input type="text" class="form-control" disabled value="{{ $m->no_plat }}">
      </div>
      <div class="form-group col-md-6">
        <label>Mobil</label>
        <input type="text" class="form-control" disabled value="{{ $m->nama_merk }} {{ $m->nama_tipe }}">
      </div>
    </div>
    <div class="form-group">
      <label>Harga Sewa / Hari</label>
      <div class="input-group @error('harga_sewa') is-invalid @enderror">
        <div class="input-group-prepend">
          <div class="input-group-text">Rp.</div>
        </div>
        <input type="text" name="harga_sewa" class="form-control uang @error('harga_sewa') is-invalid @enderror"
          value="{{ $m->harga_sewa }}">
      </div>
      <div class="invalid-feedback">
        harga sewa / hari harus diisi
      </div>
    </div>
    <div class="form-group">
      <label>Foto Mobil</label>
      <div class="custom-file">
        <input type="file" class="custom-file-input @error('foto_mobil') is-invalid @enderror" name="foto_mobil">
        <label class="custom-file-label">Pilih Gambar</label>
      </div>
      <small class="text-muted">Kosongkan jika tidak ingin mengubah</small>
      <div class="invalid-feedback">
        foto mobil harus valid
      </div>
    </div>
    @endmodal

    @modal
    @slot('id_modal') hapus-{{ $m->id }} @endslot
    @slot('modal_title', 'Hapus Data')
    @slot('modal_submit', 'Hapus')

    @slot('form_action')
    {{ route('admin.mobil.hapus', $m->id) }}
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
{{ route('admin.mobil.simpan') }}
@endslot

@csrf
<div class="form-group">
  <label>No Plat</label>
  <input type="text" name="no_plat" class="form-control @error('no_plat') is-invalid @enderror">
  <div class="invalid-feedback">
    nomor plat harus diisi
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-6">
    <label>Merk Mobil</label>
    <select name="kode_merk" id="kode_merk" class="form-control @error('kode_merk') is-invalid @enderror">
      <option selected disabled>Pilih Merk</option>
      @foreach ($merk as $mr)
      <option value="{{ $mr->kode_merk }}">{{ $mr->nama_merk }}</option>
      @endforeach
    </select>
    <div class="invalid-feedback">
      merk mobil harus dipilih
    </div>
  </div>
  <div class="form-group col-md-6">
    <label>Tipe Mobil</label>
    <div id="tipe">
      <input type="text" class="form-control" disabled placeholder="Pilih merk terlebih dahulu">
    </div>
    <div class="invalid-feedback">
      tipe mobil harus pilih
    </div>
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-6">
    <label>Jenis Mobil</label>
    <select name="jenis_mobil" id="jenis_mobil" class="form-control @error('jenis_mobil') is-invalid @enderror">
      <option selected disabled>Pilih Jenis</option>
      <option>SPV</option>
      <option>MPV</option>
      <option>City</option>
    </select>
    <div class="invalid-feedback">
      jenis mobil harus dipilih
    </div>
  </div>
  <div class="form-group col-md-6">
    <label>Tipe Transmisi</label>
    <select name="transmisi" id="transmisi" class="form-control @error('transmisi') is-invalid @enderror">
      <option selected disabled>Pilih Transmisi</option>
      <option>Manual</option>
      <option>Matic</option>
      <option>CVT</option>
    </select>
    <div class="invalid-feedback">
      tipe transmisi harus pilih
    </div>
  </div>
</div>
<div class="form-group">
  <label>Harga Sewa / Hari</label>
  <div class="input-group @error('harga_sewa') is-invalid @enderror">
    <div class="input-group-prepend">
      <div class="input-group-text">Rp.</div>
    </div>
    <input type="text" name="harga_sewa" class="form-control uang @error('harga_sewa') is-invalid @enderror">
  </div>
  <div class="invalid-feedback">
    harga sewa / hari harus diisi
  </div>
</div>
<div class="form-group">
  <label>Foto Mobil</label>
  <div class="custom-file">
    <input type="file" class="custom-file-input @error('foto_mobil') is-invalid @enderror" name="foto_mobil">
    <label class="custom-file-label">Pilih Gambar</label>
  </div>
  <div class="invalid-feedback">
    foto mobil harus valid
  </div>
</div>
@endmodal

@endsection

@section('script')
<script>
  $(document).ready(function(){
    $('#kode_merk').change(function(){
      let merk = $(this).val();
      console.log(merk);
      $('#tipe').load('{{ route("admin.mobil") }}/getTipe/'+merk);
    })
  })
</script>
@endsection