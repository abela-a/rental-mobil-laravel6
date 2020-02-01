<nav id="sidebar">
  <div class="custom-menu">
    <button type="button" id="sidebarCollapse" class="btn btn-primary">
      <i class="fa fa-angle-right"></i>
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
              <img src="{{ asset('img/fotouser/default.png') }}" class="mr-3 border rounded" width="45" height="45">
              <div class="media-body">
                <h6 class="my-0">Abel Ardhana S</h6>
                <span class="badge badge-info">Admin</span>
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
              <button class="btn btn-sm btn-danger btn-block">Logout</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    @php
    if(Request::is('*admin') || Request::is('*karyawan') || Request::is('*pelanggan')){
    $dashboard = 'active';
    }
    if(Request::is('*merk') || Request::is('*tipe') || Request::is('*mobil')){
    $kendaraan = 'active';
    }
    if(Request::is('*sopir')){
    $sopir = 'active';
    }
    if(Request::is('*merk') || Request::is('*tipe') || Request::is('*mobil')){
    $show_kendaraan = 'show';
    }
    @endphp

    <ul class="list-unstyled components accordion px-4" id="accordion-sidebar">
      <li class="{{ $dashboard ?? '' }}">
        <a href="{{ route('admin.dashboard') }}">
          <span class="fa fa-fw text-white fa-tachometer-alt mr-3"></span> Dashboard
        </a>
      </li>
      <li class="{{ $kendaraan ?? '' }}">
        <a href="#kendaraan" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          <span class="fa fa-fw text-white fa-car mr-3"></span>Kendaraan
        </a>
        <ul class="collapse list-unstyled {{ $show_kendaraan ?? '' }}" id="kendaraan" data-parent="#accordion-sidebar">
          <li>
            <a href="{{ route('admin.merk') }}" class="{{ Request::is('*merk') ? 'text-active' : '' }}">Merk</a>
          </li>
          <li>
            <a href="{{ route('admin.tipe') }}" class="{{ Request::is('*tipe') ? 'text-active' : '' }}">Tipe</a>
          </li>
          <li> <a href="{{ route('admin.mobil') }}" class="{{ Request::is('*mobil') ? 'text-active' : '' }}">Mobil</a>
          </li>
        </ul>
      </li>
      <li>
        <a href="#transaksi" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span
            class="fa fa-fw text-white fa-dollar-sign mr-3"></span>Transaksi</a>
        <ul class="collapse list-unstyled" id="transaksi" data-parent="#accordion-sidebar">
          <li> <a href="#">Pemesanan</a> </li>
          <li> <a href="#">Tipe</a> </li>
        </ul>
      </li>
      <li class="{{ $sopir ?? '' }}">
        <a href="{{ route('admin.sopir') }}"><span class="fa fa-fw text-white fa-user-tie mr-3"></span>Data Sopir</a>
      </li>
      <li>
        <a href="#akun" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span
            class="fa fa-fw text-white fa-users mr-3"></span>Data Akun</a>
        <ul class="collapse list-unstyled" id="akun" data-parent="#accordion-sidebar">
          <li> <a href="#">Pelanggan</a> </li>
          <li> <a href="#">Karyawan</a> </li>
          <li> <a href="#">Manajemen Akses</a> </li>
        </ul>
      </li>
      <li>
        <a href="#"><span class="fa fa-fw text-white fa-print mr-3"></span>Laporan</a>
      </li>
    </ul>
  </div>
</nav>