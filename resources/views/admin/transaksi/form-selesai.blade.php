@extends('layouts.master')

@section('title', 'Transaksi - Abidzar Car Rental')
@section('header', 'Pengembalian Mobil')
@section('deskripsi', 'Form pengembalian mobil bagi pelanggan yang telah habis masa rentalnya.')

@section('style')
<link rel="stylesheet" href="{{ asset('vendor/datepicker/datepicker.min.css') }}">
@endsection

@section('button')
<a class="btn btn-danger" href="javascript:history.back()"><i class="fas fa-times fa-fw mr-2"></i>Batalkan</a>
@endsection

@section('content')
<form action="{{ route('admin.transaksi.selesai', $transaksi->id) }}" method="post">
  @csrf @method('patch')

  <h2 class="mt-5">Informasi</h2>
  <hr>

  <div class="row">
    <div class="col">
      <div class="form-group">
        <label for="no_transaksi">Kode Transaksi</label>
        <input type="text" class="form-control" name="no_transaksi" id="no_transaksi"
          value="{{ $transaksi->no_transaksi }}" readonly>
      </div>

      <div class="form-group">
        <label for="identitas">Penyewa</label>
        <input type="text" class="form-control" id="identitas" value="{{ $transaksi->nama }}" readonly>
      </div>

      <div class="form-group">
        <label for="mobil">Mobil</label>
        <input type="text" class="form-control" id="mobil"
          value="{{ $transaksi->no_plat .' - '. $transaksi->nama_merk .' '. $transaksi->nama_tipe }}" readonly>
      </div>

      <div class="form-group">
        <label for="sopir">Sopir</label>
        <input type="text" class="form-control" id="sopir" value="{{ $transaksi->nama_sopir }}" readonly>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <label for="tanggal_pesan">Tanggal Pesan</label>
        <input type="text" class="form-control" id="tanggal_pesan" readonly
          value="{{ $transaksi->tanggal_pesan->format('d F Y') }}">
      </div>

      <div class="form-group">
        <label for="tanggal_pinjam">Tanggal Mulai Rental</label>
        <input type="text" class="form-control datepicker" id="tanggal_pinjam" readonly
          value="{{ $transaksi->tanggal_pinjam->format('d F Y') }}">
      </div>

      <div class="form-group">
        <label for="tanggal_kembali_rencana">Tanggal Selesai Rental</label>
        <input type="text" class="form-control datepicker" id="tanggal_kembali_rencana" name="tanggal_kembali_rencana"
          readonly value="{{ $transaksi->tanggal_kembali_rencana->format('d F Y') }}">
      </div>
      <div class="form-group">
        <label for="tanggal_kembali_sebenarnya">Tanggal Dikembalikan</label>
        <input type="text" class="form-control datepicker border border-info" id="tanggal_kembali_sebenarnya"
          name="tanggal_kembali_sebenarnya" readonly placeholder="Masukkan tanggal">
      </div>
    </div>
  </div>

  <h2 class="mt-4">Pembayaran</h2>
  <hr>

  <div class="row">
    <div class="col">
      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="lama_rental">Lama Rental</label>
            <div class="input-group">
              <input type="text" class="form-control" id="lama_rental" readonly value="{{ $transaksi->lama_rental }}">
              <div class="input-group-append">
                <span class="input-group-text">Hari</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="lama_denda">Lama Jatuh Tempo</label>
            <div class="input-group">
              <input type="text" class="form-control" name="lama_denda" id="lama_denda" readonly>
              <div class="input-group-append">
                <span class="input-group-text">Hari</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="denda">Denda</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Rp.</span>
          </div>
          <input type="text" class="form-control" name="denda" id="denda" readonly>
        </div>
      </div>
      <div class="form-group">
        <label for="harga_sewa">Harga Sewa / Hari</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Rp.</span>
          </div>
          <input type="text" class="uang form-control" id="harga_sewa" readonly value="{{ $transaksi->harga_sewa }}">
        </div>
      </div>

      <div class="form-group">
        <label for="tarif_perhari">Tarif Sopir / Hari</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Rp.</span>
          </div>
          <input type="text" class="uang form-control" id="tarif_perhari" readonly
            value="{{ $transaksi->tarif_perhari }}">
        </div>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <label for="biaya_bbm">Biaya BBM</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Rp.</span>
          </div>
          <input type="text" class="uang form-control" name="biaya_bbm" id="biaya_bbm" value="0" autocomplete="off">
        </div>
      </div>
      <div class="form-group">
        <label for="biaya_kerusakan">Biaya Kerusakan</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Rp.</span>
          </div>
          <input type="text" class="uang form-control" name="biaya_kerusakan" id="biaya_kerusakan" value="0"
            autocomplete="off" style="z-index:0">
        </div>
      </div>
      <div class="form-group">
        <label for="kerusakan">Deskripsi kerusakan</label>
        <textarea class="form-control" style="height:127px!important" id="kerusakan" name="kerusakan" required
          autocomplete="off" rows="4"></textarea>
      </div>
    </div>
  </div>

  <div class="card border-success p-3 text-white mt-4">
    <div class="form-group">
      <label for="total_bayar" class="text-success">Total Bayar</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Rp.</span>
        </div>
        <input type="text" class="totalBiaya form-control" id="total_bayar" name="total_bayar"
          value="{{ $transaksi->total_bayar }}" readonly>
      </div>
    </div>

    <div class="form-group">
      <label for="jumlah_bayar" class="text-success">Jumlah Bayar</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Rp.</span>
        </div>
        <input type="text" class="uang form-control" name="jumlah_bayar" id="jumlah_bayar" autocomplete="off">
      </div>
    </div>

    <div class="form-group">
      <label for="kembalian" class="text-success">Kembalian</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Rp.</span>
        </div>
        <input type="text" class="uang form-control" name="kembalian" id="kembalian" readonly>
      </div>

      <input type="hidden" name="mobil_id" value="{{ $transaksi->mobil_id }}">
      <input type="hidden" name="sopir_id" value="{{ $transaksi->sopir_id }}">

    </div>
    <button class="btn btn-success btn-block" type="submit">RENTAL SELESAI</button>
  </div>
</form>
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