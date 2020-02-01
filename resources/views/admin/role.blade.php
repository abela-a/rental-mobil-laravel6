@extends('layouts.master')

@section('title', 'Role - Abidzar Car Rental')
@section('header', 'Role')
@section('deskripsi', 'Menampilkan daftar akun dengan rolenya.')

@section('content')
<table class="table table-bordered" id="tolong">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">NIK</th>
      <th scope="col">Nama</th>
      <th scope="col">Role</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $user)
    <tr>
      <form action="{{ route('admin.akun.role', $user->id) }}" method="post">
        @csrf @method('patch')
        <th scope="row" class="first-td">{{ $loop->iteration }}</th>
        <td>{{ $user->nik }}</td>
        <td>
          <img src="{{ asset('img/fotouser') }}/{{ $user->foto }}" height="50px" class="border rounded mr-2">
          {{ $user->nama }}
        </td>
        <td>
          <select name="role_id" class="form-control">
            <option value="1" @if($user->role_id === 1) selected @endif>Admin</option>
            <option value="2" @if($user->role_id === 2) selected @endif>Karyawan</option>
            <option value="3" @if($user->role_id === 3) selected @endif>Pelanggan</option>
          </select>
        </td>
        <td class="action-td">
          <button class="btn btn-sm btn-success" type="submit">
            <i class="fas fa-check fa-fw"></i> Ubah
          </button>
        </td>
      </form>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection