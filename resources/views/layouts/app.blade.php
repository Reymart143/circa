@include('layouts.header')

  @include('layouts.navbar')
  <div class="app-main">
    @include('layouts.sidebar')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
    @yield('content')
@include('layouts.footer')
  