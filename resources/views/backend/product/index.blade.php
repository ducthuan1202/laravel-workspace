<?php
/**
 * @var \App\Entities\Product $model
 * @var \App\Entities\Product[] $data
 */
?>

@extends('backend.layouts.main')

@section('title') {{ $title }} @endsection

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3">
        <h1 class="h2">Dashboard <button type="button" class="btn btn-primary">
                Notifications <span class="badge badge-light">4</span>
            </button>
        </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>

                <button type="button" class="btn btn-outline-primary">Primary</button>
                <button type="button" class="btn btn-outline-success">Success</button>
                <button type="button" class="btn btn-outline-danger">Danger</button>
                <button type="button" class="btn btn-outline-warning">Warning</button>
                <button type="button" class="btn btn-outline-info">Info</button>
                <button type="button" class="btn btn-outline-dark">Dark</button>
                <button type="button" class="btn btn-outline-secondary">Secondary</button>


            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                This week
            </button>
        </div>
    </div>

    @include('backend.product.partials._search')

    <div class="card" id="arena-block-ui">
{{--        <div class="card-header">--}}
{{--            <h6>--}}
{{--                {{ $title }}--}}
{{--                <a href="javascript:void(0)" class="btn btn-info float-right btn-sm" data-function="loadForm">--}}
{{--                    Thêm mới--}}
{{--                </a>--}}
{{--            </h6>--}}
{{--        </div>--}}
        <div class="card-body-custom">

            @include('backend.layouts.partials.alert')

            <div class="table-responsive" id="grid-table-data" style="min-height: 200px;"></div>

        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static"></div>

@endsection

@push('scripts')
    <script src="{{ asset('vendor/mask/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('vendor/slimscroll/jquery.slimscroll.min.js') }}"></script>
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
            product.loadFormUrl = '{{ admin_route('products.open_form') }}';
            product.saveFormUrl = '{{ admin_route('products.save_form') }}';
            product.divErrorId = 'ajaxErrors';
            product.urlGetData = '{{admin_route('products.get_data')}}';

            product.init();

            product.getData();

        })
    </script>
@endpush
