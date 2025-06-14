<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | {{ config('app.name') }}</title>
    @include('styles.style')
  </head>
  <body>

    @include('partials.navbar')

    <div class="container py-5">
        @yield('content')
    </div>

    @include('partials.footer')

    @include('scripts.script')
  </body>
</html>