<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script>
        window.App = {!! json_encode([
              'csrfToken' => csrf_token(),
              'user' => Auth::user(),
              'signIn' => Auth::check(),
         ]) !!};
    </script>

    <style>
        body{ padding-bottom: 100px; }
        .level { display: flex;align-items: center; }
        .flex { flex: 1 }
        .mr-1 {margin-right: 1em;}
        [v-cloak] { display: none; }
    </style>

    @yield('header')
</head>
<body>
    <div id="app">
        @include('layouts.nav')

        @yield('content')

        <flash message="{{ session('flash') }}"></flash>
    </div>

    @if (app()->isLocal())
        @include('sudosu::user-selector')
    @endif

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('scripts')
</body>
</html>
