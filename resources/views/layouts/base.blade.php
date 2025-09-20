<html>
  <head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Default Title') | {{ env('APP_NAME') }}</title>

    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    {{-- TBA template/bootstrap/tailwind css --}}
  </head>
  <body style="margin: 0">
    @include('includes.header')

    <div>
      @yield('content')
    </div>

    @include('includes.footer')
    
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    {{-- TBA template/bootstrap/tailwind and xendit js scripts --}}
  </body>
</html>