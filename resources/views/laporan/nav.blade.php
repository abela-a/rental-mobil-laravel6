<div id="no-print">
  <ul class="nav nav-pills">
    <li class="nav-item">
      <a class="nav-link {{ Request::is('*laporan') ? 'active' : '' }}" href="{{ route($role.'.laporan') }}">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ Request::is('*laporan/transaksi') ? 'active' : '' }}"
        href="{{ route($role.'.laporan.transaksi') }}">Transaksi</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ Request::is('*laporan/kendaraan') ? 'active' : '' }}"
        href="{{ route($role.'.laporan.kendaraan') }}">Kendaraan</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ Request::is('*laporan/sopir') ? 'active' : '' }}"
        href="{{ route($role.'.laporan.sopir') }}">Sopir</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ Request::is('*laporan/karyawan') ? 'active' : '' }}"
        href="{{ route($role.'.laporan.karyawan') }}">Karyawan</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ Request::is('*laporan/pelanggan') ? 'active' : '' }}"
        href="{{ route($role.'.laporan.pelanggan') }}">Pelanggan</a>
    </li>
  </ul>
  <hr>
</div>