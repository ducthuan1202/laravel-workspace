<?php
/**
 * @var \App\Entities\Category $model
 * @var \App\Entities\Category[] $data
 */
?>

@extends('backend.layouts.main')

@section('title') {{ $title }} @endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <h6>
                {{ $title }}
                <a href="{{ admin_route('categories.create') }}" class="btn btn-info float-right btn-sm">Thêm mới</a>
            </h6>
        </div>
        <div class="card-body-custom">

            @include('backend.layouts.partials.alert')

            <div class="table-responsive" id="grid-table-data" style="min-height: 200px;"></div>

        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ admin_asset('js/pages/tbl-category.js') }}"></script>
    <script>
        const category = new Category();

        /*
        |--------------------------------------------------------------------------
        | Document on ready jquery event
        |--------------------------------------------------------------------------
        */
        $(document).ready(function () {
            category.urlGetData = '{{admin_route('categories.get_data')}}';
            category.getData();
        })
    </script>
@endpush
