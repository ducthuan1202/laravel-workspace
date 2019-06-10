<?php
/**
 * @var \App\Entities\Log $model
 * @var \App\Entities\Log[] $data
 */
?>

@extends('backend.layouts.main')

@section('title') {{ $title }} @endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <h6>{{ $title }}</h6>
        </div>
        <div class="card-body-custom">
            @include('backend.layouts.partials.alert')

            @include('backend.layouts.partials.paginate')

            @include('backend.log.partials._table')

            @include('backend.layouts.partials.paginate')
        </div>
    </div>

@endsection
