<!doctype html>
<html>
<head>
    <title>@yield('title')</title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('favicon.ico') }}"/>
    <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet"/>
</head>
<body>

<div class="container-fluid">
    @yield('content')
</div>

</body>
</html>
