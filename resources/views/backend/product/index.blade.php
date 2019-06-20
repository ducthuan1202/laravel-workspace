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

@push('scripts')
    <script src="{{ admin_asset('js/tbl-product.js') }}"></script>
    <script>
        var product = new Product();
        product.loadFormUrl = '{{ admin_route('products.create') }}';
        product.saveFormUrl = '{{ admin_route('products.store') }}';

        $(document).ready(function () {

            $("[data-function='loadForm']").on('click', function () {
                product.loadForm();
            });

            $("#exampleModal").on('click', "[data-function='saveForm']", function () {
                var data = $("#exampleModal form").serializeArray();
                product.saveForm(data);
            });

        })
    </script>
@endpush
