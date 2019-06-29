<?php
/**
 * @var \App\Admin $admin
 */

$admin = auth()->user();
?>
@extends('backend.layouts.main')

@section('title') {{ $title }} @endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <h6> Socket IO </h6>
        </div>

    </div>

@endsection

@push('scripts')
    <script src="{{ asset('vendor/socket/socket.io.js') }}"></script>
    <script>

        const socket = io('http://127.0.0.1:3000');

        const SOCKET_EVENTS = {
            EMIT_ALL: 'emit_all',
        };

        socket.emit(SOCKET_EVENTS.EMIT_ALL, {time: '{{ \Illuminate\Support\Str::random() }}', event: 'emit all'});

    </script>
@endpush