<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title')</title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('favicon.ico') }}"/>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/pnotify/dist/pnotify.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/pnotify/dist/pnotify.buttons.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/pnotify/dist/pnotify.nonblock.css') }}" />
    <link rel="stylesheet" href="{{ admin_asset('css/app.css') }}"/>

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

<script src="{{ asset('vendor/bootstrap/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/popper.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/mask/jquery.mask.min.js') }}"></script>
<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
<script src="{{ asset('vendor/pnotify/dist/pnotify.js') }}"></script>
<script src="{{ asset('vendor/pnotify/dist/pnotify.buttons.js') }}"></script>
<script src="{{ asset('vendor/blockui/jquery.blockui.min.js') }}"></script>

<script src="{{ admin_asset('js/closures.js') }}"></script>
<script src="{{ admin_asset('js/app.js') }}"></script>
@stack('scripts')

</body>
</html>
