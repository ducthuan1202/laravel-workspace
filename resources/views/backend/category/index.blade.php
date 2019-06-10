<?php
/**
 * @var \App\Entities\Teacher $model
 * @var \App\Entities\Teacher[] $data
 */
?>

@extends('backend.layouts.main')

@section('title') {{ $title }} @endsection

@section('content')

    @include('backend.category.partials._search')

    <div class="card">
        <div class="card-header">
            <h6>
                {{ $title }}
                <a href="{{ admin_route('categories.create') }}" class="btn btn-info float-right btn-sm">Thêm mới</a>
            </h6>
        </div>
        <div class="card-body-custom">
            @include('backend.layouts.partials.alert')

            @include('backend.layouts.partials.paginate')

            @include('backend.category.partials._table')

            @include('backend.layouts.partials.paginate')
        </div>
    </div>

@endsection
