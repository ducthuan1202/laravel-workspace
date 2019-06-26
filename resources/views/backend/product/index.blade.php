<?php
/**
 * @var \App\Entities\Product $model
 * @var \App\Entities\Product[] $data
 */
?>

@extends('backend.layouts.main')

@section('title') {{ $title }} @endsection

@section('content')

    @include('backend.product.partials._search')

    <div class="card">
        <div class="card-header">
            <h6>
                {{ $title }}
                <a href="javascript:void(0)" class="btn btn-info float-right btn-sm" data-function="loadForm">
                    Thêm mới
                </a>
            </h6>
        </div>
        <div class="card-body-custom">

            @include('backend.layouts.partials.alert')

            @include('backend.product.partials._table')

            @include('backend.layouts.partials.paginate')
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true" data-keyboard="false" data-backdrop="static"></div>

@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}" />
    <style>
        .select2-container--classic .select2-selection--single .select2-selection__arrow{ height: 38px!important;}
        .select2-container--classic .select2-selection--single,
        .select2-container--classic .select2-selection--single .select2-selection__rendered{height: 40px!important; line-height: 40px!important;}
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('vendor/mask/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script src="{{ admin_asset('js/pages/tbl-product.js') }}"></script>
    <script>
        const product = new Product();

        /*
        |--------------------------------------------------------------------------
        | Document on ready jquery event
        |--------------------------------------------------------------------------
        */
        $(document).ready(function () {
            product.loadFormUrl = '{{ admin_route('products.create') }}';
            product.saveFormUrl = '{{ admin_route('products.store') }}';
            product.divErrorId = 'ajaxErrors';
            product.init();
        })
    </script>
@endpush
