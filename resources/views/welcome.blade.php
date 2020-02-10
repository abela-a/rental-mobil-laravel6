@extends('layouts.master')

@section('title', 'Abidzar Car Rental')

@section('style')
<style>
  .h-100 {
    height: 100vh !important;
  }
</style>
@endsection

@section('home')
<div class="container h-100">
  <div class="row align-items-center h-100">
    <div class="col-6 mx-auto">
      <div class="jumbotron">
        <h1 id="header" class="text-center">Homepage</h1>
      </div>
      <div class="row no-gutters mt-n4">
        @auth
        <div class="col">
          <a href="{{ route('login') }}" class="btn btn-primary btn-block">Dashboard</a>
        </div>
        @else
        <div class="col mr-2">
          <a href="{{ route('login') }}" class="btn btn-secondary btn-block">Login</a>
        </div>
        <div class="col">
          <a href="{{ route('register') }}" class="btn btn-secondary btn-block">Register</a>
        </div>
        @endauth
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
{{--  --}}
@endsection