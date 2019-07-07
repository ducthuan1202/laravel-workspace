<?php
/**
 * @var \App\Admin $userLogin
 * @var string $ip
 * @var string $userAgent
 * @var string $title
 */
?>

@extends('backend.layouts.mail')

@section('content')

    <h1>{{ $title }}</h1>

    <div>
        Thành viên {{ $userLogin->name }} ({{ $userLogin->email }}) vừa đăng nhập vào hệ thống:<br/>
        IP: {{ $ip }}<br/>
        UserAgent: {{ $userAgent }}
    </div>
@endsection



