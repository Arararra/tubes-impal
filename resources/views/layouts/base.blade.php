<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="author" content="kelompok-01-03">
    <meta name="keywords" content="ambabakey">
    <meta name="description" content="website coba coba ambabakey">

    <title>@yield('title', 'Default Title') | {{ env('APP_NAME') }}</title>

    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond:300i,400,400i,500,500i,600,600i,700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('themes/plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/plugins/bootstrap4/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/plugins/lightGallery-master/dist/css/lightgallery.min.css') }}">
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
    <script src="{{ asset('themes/plugins/imagesloaded.pkgd.js') }}"></script>
    <script src="{{ asset('themes/plugins/jquery.matchHeight-min.js') }}"></script>
    <script src="{{ asset('themes/plugins/lightGallery-master/dist/js/lightgallery-all.min.js') }}"></script>
    <script src="{{ asset('themes/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('themes/plugins/sticky-sidebar/dist/sticky-sidebar.min.js') }}"></script>
    <script src="{{ asset('themes/plugins/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('themes/js/main.js') }}"></script>
  </body>
</html>