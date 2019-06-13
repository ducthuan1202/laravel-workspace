<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('backend/css/app.css') }}" rel="stylesheet"/>
</head>
<body>
    <main class="py-4">
        @yield('content')
    </main>

    <script src="{{ asset('backend/js/jquery-3.2.1.slim.min.js') }}"></script>
    <script src="{{ asset('backend/js/popper.min.js') }}"></script>
    <script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/js/app.js') }}"></script>
</body>
</html>
