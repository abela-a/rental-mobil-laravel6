@extends('layouts.master')

@section('title', 'Transaksi - Abidzar Car Rental')
@section('header', 'Transaksi')
@section('deskripsi', 'Menampilkan transaksi yang selesai atau dibatalkan.')

@section('style')
<link rel="stylesheet" href="{{ asset('vendor/datepicker/datepicker.min.css') }}">
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
    @foreach ($transaksi as $data)
    <tr>
      <th scope="row" class="first-td">{{ $loop->iteration }}</th>
      <td>
        {{ $data->no_transaksi }} <br>
        @if ($data->status_transaksi == 'Selesai')
        <span class="badge badge-success shadow-none">Selesai</span>
        @else
        <span class="badge badge-danger shadow-none">Batal</span>
        @endif
      </td>
      <td>{{ $data->nama }}</td>
      <td>{!! $data->no_plat . '<br> ' . $data->nama_merk . '<br>' .$data->nama_tipe !!}</td>
      <td>{{ $data->tanggal_pesan->format('d/m/Y') }}</td>
      <td>{{ $data->lama_rental }} Hari</td>
      <td>Rp. <span class="uang">{{ $data->total_bayar }}</span>,-</td>
      <td class="action-td">
        <a href="{{ route($role.'.laporan.kwitansi', $data->id) }}">
          <button class="btn btn-sm btn-info text-white">
            <i class=" fa fa-print fa-fw"></i>
          </button>
        </a>
        <button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#detail-{{ $data->id }}">
          <i class="fa fa-bars fa-fw"></i>
        </button>
      </td>
    </tr>

    @modal
    @slot('id_modal')
    detail-{{$data->id}}
    @endslot
    @slot('modal_title', 'Detail Transaksi')
    @slot('modal_submit', 'Detail')

    <ul class="list-group list-group-flush">

      <div class="row list-group-item grey lighten-5">
        <div class="col">No Transaksi</div>
        <div class="col" style="font-weight:500">{{ $data->no_transaksi }}</div>
      </div>

      <div class="row list-group-item grey lighten-5">
        <div class="col">Nama Pemesan</div>
        <div class="col" style="font-weight:500">{{ $data->nama }}</div>
      </div>

      <div class="row list-group-item grey lighten-5">
        <div class="col">Mobil</div>
        <div class="col" style="font-weight:500">
          {{ $data->no_plat .' - '. $data->nama_merk .' '. $data->nama_tipe }}
        </div>
      </div>

      <div class="row list-group-item grey lighten-5">
        <div class="col">Sopir</div>
        <div class="col" style="font-weight:500">
          {{ $data->nama_sopir }}
        </div>
      </div>

      <div class="row list-group-item grey lighten-5">
        <div class="col">Tanggal Pesan</div>
        <div class="col" style="font-weight:500">
          {{ $data->tanggal_pesan }}
        </div>
      </div>

      <div class="row list-group-item grey lighten-5">
        <div class="col">Tanggal Mulai</div>
        <div class="col" style="font-weight:500">
          {{ $data->tanggal_pinjam->format('d F Y') }}
        </div>
      </div>

      <div class="row list-group-item grey lighten-5">
        <div class="col">Tanggal Rencana Pengembalian</div>
        <div class="col" style="font-weight:500">
          {{ $data->tanggal_kembali_rencana->format('d F Y') }}
        </div>
      </div>

      <div class="row list-group-item grey lighten-5">
        <div class="col">Lama Rental</div>
        <div class="col" style="font-weight:500">
          {{ $data->lama_rental }} Hari
        </div>
      </div>

      <div class="row list-group-item grey lighten-5">
        <div class="col">Tanggal Dikembalikan</div>
        <div class="col" style="font-weight:500">
          @isset($data->tanggal_kembali_sebenarnya)
          {{ $data->tanggal_kembali_sebenarnya->format('d F Y') }}
          @else
          -
          @endisset
        </div>
      </div>

      <div class="row list-group-item grey lighten-5">
        <div class="col">Lama Jatuh Tempo</div>
        <div class="col" style="font-weight:500">
          {{ $data->lama_denda }} Hari
        </div>
      </div>

      <div class="row list-group-item grey lighten-5">
        <div class="col">Kerusakan</div>
        <div class="col" style="font-weight:500">
          {{ $data->kerusakan }}
        </div>
      </div>

      <div class="row list-group-item grey lighten-5">
        <div class="col">Biaya Kerusakan</div>
        <div class="col" style="font-weight:500">
          Rp. <span class="uang">{{ $data->biaya_kerusakan }}</span>,-
        </div>
      </div>

      <div class="row list-group-item grey lighten-5">
        <div class="col">Biaya BBM</div>
        <div class="col" style="font-weight:500">
          Rp. <span class="uang">{{ $data->biaya_bbm }}</span>,-
        </div>
      </div>

      <div class="row list-group-item grey lighten-5">
        <div class="col">Denda Jatuh Tempo</div>
        <div class="col" style="font-weight:500">
          Rp. <span class="uang">{{ $data->biaya_denda }}</span>,-
        </div>
      </div>

      <div class="row list-group-item grey lighten-5">
        <div class="col">Tarif Sopir / Hari</div>
        <div class="col" style="font-weight:500">
          Rp. <span class="uang">{{ $data->tarif_perhari }}</span>,-
        </div>
      </div>

      <div class="row list-group-item grey lighten-5">
        <div class="col">Harga Sewa Mobil / Hari</div>
        <div class="col" style="font-weight:500">
          Rp. <span class="uang">{{ $data->harga_sewa }}</span>,-
        </div>
      </div>

      <div class="row list-group-item grey lighten-5">
        <div class="col">Total Bayar</div>
        <div class="col red-text" style="font-weight:500">
          Rp. <span class="uang">{{ $data->total_bayar }}</span>,-
        </div>
      </div>

      <div class="row list-group-item grey lighten-5">
        <div class="col">Jumlah Bayar</div>
        <div class="col text-success" style="font-weight:500">
          Rp. <span class="uang">{{ $data->jumlah_bayar }}</span>,-
        </div>
      </div>

      <div class="row list-group-item grey lighten-5">
        <div class="col">Kembalian</div>
        <div class="col text-danger" style="font-weight:500">
          Rp. <span class="uang">{{ $data->kembali }}</span>,-
        </div>
      </div>

    </ul>

    @endmodal

    @endforeach
  </tbody>
</table>

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