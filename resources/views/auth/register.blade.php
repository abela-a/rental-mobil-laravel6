@extends('layouts.master')

@section('title', 'Register - Abidzar Car Rental')

@section('style')
{{--  --}}
@endsection

@section('auth')
<div class="row no-gutters justify-content-center">
  <div class="col-md-5 my-5">
    <div class="card border-0">
      <div class="card-body p-5">
        <h1 class="card-title mb-4" id="header">Register</h1>
        <span class="card-text text-muted"><strong>Abidzar Car Rental</strong>
          - Mengapa memilih kami? Kami adalah penyedia layanan sewa mobil di Makassar yang sudah berpengalaman dalam
          menyediakan mobil berkualitas dengan harga murah sejak tahun 2019.</span>
        <hr>
        <form action="{{ route('register') }}" method="post">
          @csrf
          <div class="form-group">
            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" autofocus placeholder="Nama lengkap"
              value="{{ old('nama') }}">
            <div class="invalid-feedback">
              @error('nama')
              {{ $message }}
              @enderror
            </div>
          </div>
          <div class="form-group">
            <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik"  placeholder="NIK"
              value="{{ old('nik') }}">
            <div class="invalid-feedback">
              @error('nik')
              {{ $message }}
              @enderror
            </div>
          </div>
          <div class="form-group">
            <input type="text" class="form-control telp @error('nohp') is-invalid @enderror" name="nohp"  placeholder="Nomor Ponsel"
              value="{{ old('nohp') }}">
            <div class="invalid-feedback">
              @error('nohp')
              {{ $message }}
              @enderror
            </div>
          </div>
          <div class="form-group">
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"  placeholder="Email"
              value="{{ old('email') }}">
            <div class="invalid-feedback">
              @error('email')
              {{ $message }}
              @enderror
            </div>
          </div>
          <div class="form-group">
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"  placeholder="Password">
            <div class="invalid-feedback">
              @error('password')
              {{ $message }}
              @enderror
            </div>
            <input type="password" id="password-confirm"
              class=" mt-2 form-control @error('password') is-invalid @enderror" name="password_confirmation"
              placeholder="Konfirmasi Password">
          </div>
          <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit">Register</button>
          </div>
          <hr>
          <small>Sudah punya akun? <a href="{{ route('login') }}">Login.</a></small>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
{{--  --}}
@endsection