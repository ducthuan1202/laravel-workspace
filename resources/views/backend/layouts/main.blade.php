<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title')</title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('favicon.ico') }}"/>
    <link href="{{ admin_asset('css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ admin_asset('css/app.css') }}" rel="stylesheet"/>

    @stack('style')
</head>
<body>

{{--@include('backend.layouts.partials.header')--}}

<div class="container-fluid">
    <div class="row">
        @include('backend.layouts.partials.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            @yield('content')
        </main>
    </div>
</div>

<script src="{{ admin_asset('js/jquery.min.js') }}"></script>
<script src="{{ admin_asset('js/jquery-3.2.1.slim.min.js') }}"></script>
<script src="{{ admin_asset('js/popper.min.js') }}"></script>
<script src="{{ admin_asset('js/bootstrap.min.js') }}"></script>
<script src="{{ admin_asset('js/app.js') }}"></script>

@stack('scripts')

</body>
</html>
