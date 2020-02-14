@php
if(Request::is('admin') || Request::is('karyawan') || Request::is('pelanggan')){
$dashboard = 'active';
}
if(Request::is('*merk') || Request::is('*tipe') || Request::is('*mobil')){
$kendaraan = 'active';
}
if(Request::is('*pelanggan') || Request::is('*karyawan') || Request::is('*role')){
$akun = 'active';
}
if(Request::is('*pemesanan') || Request::is('*transaksi*')){
$transaksi = 'active';
}
if(Request::is('*sopir')){
$sopir = 'active';
}
if(Request::is('*merk') || Request::is('*tipe') || Request::is('*mobil')){
$show_kendaraan = 'show';
}
if(Request::is('*pelanggan') || Request::is('*karyawan') || Request::is('*role')){
$show_akun = 'show';
}
if(Request::is('*pemesanan') || Request::is('*transaksi')){
$show_transaksi = 'show';
}
@endphp

<nav id="sidebar">
  <div class="custom-menu">
    <button type="button" id="sidebarCollapse" class="btn btn-primary">
      <i class="fa fa-bars"></i>
      <span class="sr-only">Toggle Menu</span>
    </button>
  </div>
  <div class="py-4">
    <div id="logo-company" class="px-4">
      <div class="media">
        <img src="{{ asset('img/assets/logo.png') }}" width="60" height="60">
        <div class="media-body">
          <h1><a href="{{ url('/') }}" class="logo">Abidzar <span>Car Rental</span></a></h1>
        </div>
      </div>
    </div>

    <div id="profile-user-bg">
      <div id="profile-user">
        <a href="#profile" data-toggle="collapse" class="text-white text-decoration-none">
          <div class="p-2">
            <div class="media">
              <img src="{{ asset('img/fotouser') }}/{{ Auth::user()->foto }}" class="mr-3 border rounded" width="45"
                height="45">
              <div class="media-body">
                <h6 class="my-0">{{ Auth::user()->nama }}</h6>
                @php
                if(Auth::user()->role_id === 1){
                $role = 'Admin';
                $role_route = 'admin';
                } elseif(Auth::user()->role_id === 2){
                $role = 'Karyawan';
                $role_route = 'karyawan';
                } else {
                $role = 'Pelanggan';
                $role_route = 'pelanggan';
                }
                @endphp
                <span class="badge badge-info">{{ $role }}</span>
              </div>
            </div>
          </div>
        </a>
        <div class="collapse list-unstyled px-2" id="profile" data-parent="#accordion-sidebar">
          <div class="row no-gutters mt-2">
            <div class="col mr-1">
              <button class="btn btn-sm btn-primary btn-block">Edit</button>
            </div>
            <div class="col">
              <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display:none">@csrf</form>
              <button class="btn btn-sm btn-danger btn-block" onclick="$('#logout-form').submit()">Logout</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <ul class="list-unstyled components accordion px-4" id="accordion-sidebar">
      <li class="{{ $dashboard ?? '' }}">
        <a href="{{ route($role_route.'.dashboard') }}">
          <span class="fa fa-fw text-white fa-tachometer-alt mr-3"></span> Dashboard
        </a>
      </li>

      @if (Auth::user()->role_id === 1 || Auth::user()->role_id === 2)
      <li class="{{ $kendaraan ?? '' }}">
        <a href="#kendaraan" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          <span class="fa fa-fw text-white fa-car mr-3"></span>Kendaraan
        </a>
        <ul class="collapse list-unstyled {{ $show_kendaraan ?? '' }}" id="kendaraan" data-parent="#accordion-sidebar">
          <li>
            <a href="{{ route($role_route.'.merk') }}" class="{{ Request::is('*merk') ? 'text-active' : '' }}">Merk</a>
          </li>
          <li>
            <a href="{{ route($role_route.'.tipe') }}" class="{{ Request::is('*tipe') ? 'text-active' : '' }}">Tipe</a>
          </li>
          <li> <a href="{{ route($role_route.'.mobil') }}"
              class="{{ Request::is('*mobil') ? 'text-active' : '' }}">Mobil</a>
          </li>
        </ul>
      </li>
      <li class="{{ $transaksi ?? '' }}">
        <a href="#transaksi" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span
            class="fa fa-fw text-white fa-dollar-sign mr-3"></span>Transaksi</a>
        <ul class="collapse list-unstyled {{ $show_transaksi ?? '' }}" id="transaksi" data-parent="#accordion-sidebar">
          <li> <a href="{{ route($role_route.'.pemesanan') }}"
              class="{{ Request::is('*pemesanan') ? 'text-active' : '' }}">Pemesanan</a> </li>
          <li> <a href="{{ route($role_route.'.transaksi') }}"
              class="{{ Request::is('*transaksi') ? 'text-active' : '' }}">Transaksi</a> </li>
        </ul>
      </li>
      <li class="{{ $sopir ?? '' }}">
        <a href="{{ route($role_route.'.sopir') }}"><span class="fa fa-fw text-white fa-user-tie mr-3"></span>Data
          Sopir</a>
      </li>
      <li class="{{ $akun ?? '' }}">
        <a href="#akun" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span
            class="fa fa-fw text-white fa-users mr-3"></span>Data Akun</a>
        <ul class="collapse {{ $show_akun ?? '' }} list-unstyled" id="akun" data-parent="#accordion-sidebar">
          <li> <a href="{{ route($role_route.'.pelanggan') }}"
              class="{{ Request::is('*pelanggan') ? 'text-active' : '' }}">Pelanggan</a> </li>
          <li> <a href="{{ route($role_route.'.karyawan') }}"
              class="{{ Request::is('*karyawan') ? 'text-active' : '' }}">Karyawan</a> </li>
          <li> <a href="{{ route($role_route.'.role') }}"
              class="{{ Request::is('*role') ? 'text-active' : '' }}">Manajemen
              Akses</a> </li>
        </ul>
      </li>
      <li>
        <a href="#"><span class="fa fa-fw text-white fa-print mr-3"></span>Laporan</a>
      </li>

      @else

      @endif

    </ul>
  </div>
</nav>