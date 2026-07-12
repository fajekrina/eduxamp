<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    @include('layouts/css_global')
    @yield('css_custom')
  </head>
  <body>
    <div class="wrapper">
      <!-- Content -->
      @yield('content')
    </div>

    @include('layouts/js_global')
    @yield('js_custom')
  </body>
</html>