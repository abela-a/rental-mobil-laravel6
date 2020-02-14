<div id="content" class="pb-md-5 ml-md-4 pt-md-4">
  <div class="px-4">
    <div class="px-4 pb-0">
      <div class="clearfix">
        <div class="float-left">
          <h1 class="mt-1" id="header">
            @yield('header')
          </h1>
          <span>@yield('deskripsi')</span>
        </div>
        <div class="float-right mt-4" id="no-print"> @yield('button') </div>
      </div>
      <hr id="no-print">
    </div>
    <div class="pb-4 px-4">
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
</div>