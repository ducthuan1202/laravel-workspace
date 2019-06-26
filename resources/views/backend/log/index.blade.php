<?php
/**
 * @var \App\Entities\Log $model
 * @var \App\Entities\Log[] $data
 */

?>

@extends('backend.layouts.main')

@section('title') {{ $title }} @endsection

@section('content')

    @include('backend.log.partials._search')


    <div class="card">
        <div class="card-header">
            <h6>{{ $title }}</h6>
        </div>
        <div class="card-body-custom">

            @include('backend.log.partials._table')

            @include('backend.layouts.partials.paginate')
        </div>
    </div>

@endsection


@push('style')
    <link rel="stylesheet" href="{{ asset('vendor/daterangepicker/daterangepicker.css') }}" />

@endpush

@push('scripts')
    <script src="{{ asset('vendor/moment/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/daterangepicker/daterangepicker.min.js') }}"></script>
    <script src="{{ admin_asset('js/pages/tbl-log.js') }}"></script>
    <script>
        const log = new Log();

        /*
        |--------------------------------------------------------------------------
        | Document on ready jquery event
        |--------------------------------------------------------------------------
        */
        $(document).ready(function () {
            log.init();
        })
    </script>
@endpush