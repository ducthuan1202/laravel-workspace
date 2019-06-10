<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title')</title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('favicon.ico') }}"/>
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('frontend/css/app.css') }}" rel="stylesheet"/>

    @stack('style')
</head>
<body>
<main role="main">
    @include('frontend.layouts.partials.header')
    @yield('content')
    @include('frontend.layouts.partials.footer')

</main>

<script src="{{ asset('frontend/js/jquery-3.2.1.slim.min.js') }}"></script>
<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/app.js') }}"></script>

@stack('scripts')

</body>
</html>
