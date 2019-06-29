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
        <div class="card-body-custom">
            <button class="btn btn-secondary" id="socket-emit-one">Emit One</button>

            <button class="btn btn-info" id="socket-emit-all">Emit All</button>

            <div id="socket-result"></div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('vendor/socket/socket.io.js') }}"></script>
    <script>

        const socket = io('http://127.0.0.1:3000');

        const SOCKET_EVENTS = {
            CHANNEL_MESSAGE: 'channel_message',
            EMIT_ONE: 'emit_one',
            EMIT_ALL: 'emit_all',
        };

        function socketListener(msg) {
            $("#socket-result").append($('<p>').html(msg.data));
        }

        function socketEmit(data) {
            socket.emit(SOCKET_EVENTS.CHANNEL_MESSAGE, data);
        }

        $(document).ready(function () {

            // socket.emit(SOCKET_EVENTS.EMIT_ALL, {time: new Date(), event: 'Chào hỏi cái nhỉ'});

                // emit sự kiện tới một
            $('#socket-emit-one').on('click', function () {
                socket.emit(SOCKET_EVENTS.EMIT_ONE, {time: new Date(), event: 'emit one'});
            });

            // emit sự kiện tới tất cả
            $('#socket-emit-all').on('click', function () {
                socket.emit(SOCKET_EVENTS.EMIT_ALL, {time: new Date(), event: 'emit all'});
            });


            // Lắng nghe sự kiện
            socket.on(SOCKET_EVENTS.EMIT_ONE, function (msg) {
                socketListener(msg);
            });

            socket.on(SOCKET_EVENTS.EMIT_ALL, function (msg) {
                socketListener(msg);
            });
        });

    </script>
@endpush