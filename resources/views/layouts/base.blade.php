<html>
  <head>
    <meta charset="utf-8">
    <title>@yield('title', 'Default Title') | {{ env('APP_NAME') }}</title>

    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}\
    <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond:300i,400,400i,500,500i,600,600i,700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('themes/plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/plugins/bootstrap4/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/plugins/jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/plugins/chikery-icon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/css/style.css') }}">
  </head>
  <body>
    @include('includes.header')

    <div>
      @yield('content')
    </div>

    @include('includes.footer')
    
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="{{ asset('themes/plugins/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('themes/plugins/bootstrap4/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('themes/plugins/jquery.matchHeight-min.js') }}"></script>
    <script src="{{ asset('themes/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('themes/plugins/sticky-sidebar/dist/sticky-sidebar.min.js') }}"></script>
    <script src="{{ asset('themes/js/main.js') }}"></script>
  </body>
</html>