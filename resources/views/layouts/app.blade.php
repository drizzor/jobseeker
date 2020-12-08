<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <style>
          [x-cloak] { display: none; }

          html {
            scroll-behavior: smooth;
          }
        </style>
        @livewireStyles
        <title>Jobseeker</title>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        {{-- fontawesome --}}
        <script src="https://kit.fontawesome.com/9e89e3dc89.js" crossorigin="anonymous"></script>
    </head>

    <body>

      <div class="container mx-auto px-4">
        @include('partials.navbar')
        <livewire:flash />
        @yield('content')
      </div>

      @livewireScripts

      <script>
        window.User = {
          id: {{ optional(auth()->user())->id }}
        }
      </script>

      <script src="{{ asset('js/app.js') }}"></script>
      
    </body>

</html>