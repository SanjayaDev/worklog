<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta type="CSRF-TOKEN" value="{{ csrf_token() }}">
  <title>{{ $title ?? "Dashboard" }}</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  @stack('styles')

</head>
<body>

  <div id="app">

    @include('components.layouts.admin.sidebar', ["title" => $title ?? "Dashboard", "is_su" => $is_su])

    <div id="main">
      <header class="mb-3">
          <a href="#" class="burger-btn d-block d-xl-none">
            <i class="fas fa-bars"></i>
          </a>
      </header>

      <div class="page-heading">
        <h3>{{ $title ?? "Dashboard" }}</h3>
      </div>
      <div class="page-content">

        {!! $breadcrumb !!}

        {{ $slot }}

      </div>

      @include('components.layouts.admin.footer')
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
@include('sweetalert::alert')
@stack("script")

</body>
</html>