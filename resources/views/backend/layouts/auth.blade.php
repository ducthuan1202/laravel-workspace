<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ admin_asset('css/app.css') }}"/>
</head>
<body>
    <main class="py-4">
        @yield('content')
    </main>

    <script src="{{ asset('vendor/bootstrap/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ admin_asset('js/app.js') }}"></script>

</body>
</html>
