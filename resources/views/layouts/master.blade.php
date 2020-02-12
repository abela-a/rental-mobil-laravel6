<!DOCTYPE html>
<html lang="id">

<head>
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ asset('vendor/sidebar/sidebar.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/bootstrap/font/fontawesome/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/datatables/datatables.css') }}">
  {{-- MY STYLE --}}
  <link rel="shortcut icon" href="{{ asset('img/assets/icon.png') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/colors.css') }}">
  {{-- PAGE STYLE --}}
  @yield('style')
</head>

<body class="{{ Request::is('login') || Request::is('register') ? 'bg-light' : '' }}">

  @if (!Request::is('login') && !Request::is('register') && !Request::is('/'))
  <div class="wrapper d-flex align-items-stretch">
    @include('templates.sidebar')
    @include('templates.content')
  </div>
  @elseif(Request::is('/'))
  @yield('home')
  @endif

  @yield('auth')

  <div class="script">
    <script src="{{ asset('vendor/bootstrap/js/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('vendor/moment.js/moment.js') }}"></script>
    <script src="{{ asset('vendor/datatables/datatables.js') }}"></script>
    {{-- MY SCRIPT --}}
    <script src="{{ asset('vendor/sidebar/sidebar.js') }}"></script>
    <script src="{{ asset('js/transaksi.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    {{-- PAGE SCRIPT --}}
    @yield('script')
  </div>
</body>

</html>