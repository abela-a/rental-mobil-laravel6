@extends('layouts.master')

@section('title', 'Login - Abidzar Car Rental')

@section('style')
{{--  --}}
@endsection

@section('auth')
<div class="row no-gutters justify-content-center mt-5">
  <div class="col-md-5 my-5">
    <div class="card border-0">
      <div class="card-body p-5">
        <h1 class="card-title mb-4" id="header">Login</h1>
        <span class="card-text text-muted"><strong>Abidzar Car Rental</strong>
          - Selamat datang kembali, kami selalu
          berkomitmen
          memberikan pelayanan
          terbaik dengan mobil yang terawat dan sopir yang kompeten.</span>
        <hr>
        <form action="{{ route('login') }}" method="post">
          @csrf
          <div class="form-group">
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" autofocus
              placeholder="Email" value="{{ old('email') }}">
            <div class="invalid-feedback">
              @error('email')
              {{ $message }}
              @enderror
            </div>
          </div>
          <div class="form-group">
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
              placeholder="Password">
            <div class="invalid-feedback">
              @error('password')
              {{ $message }}
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <div class="col">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="remember" id="remember"
                  {{ old('remember') ? 'checked' : '' }}>
                <label class="custom-control-label" for="remember">Ingat saya</label>
              </div>
            </div>
            <div class="col">
              <button class="btn btn-primary btn-block" type="submit">Login</button>
            </div>
          </div>
          <hr>
          <small>Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang!</a></small>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
{{--  --}}
@endsection