<div id="content" class="py-md-5 mx-md-4 pt-5">
  <div class="px-4 pt-3 pb-0 mt-5">
    <div class="clearfix">
      <div class="float-left">
        <h1 class="mt-1" id="header">
          @yield('header')
        </h1>
        <span>@yield('deskripsi')</span>
      </div>
      <div class="float-right mt-4"> @yield('button') </div>
    </div>
  </div>
  <div class="p-4">
    @if (session('alert'))
    <div class="alert alert-success alert-dismissible fade show">
      {{ session('alert') }}
      <button data-dismiss="alert" class="close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif
    @yield('content')
  </div>
</div>