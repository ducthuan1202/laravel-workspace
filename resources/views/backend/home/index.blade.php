<?php
/**
 * @var \App\Admin $admin
 */

$admin = auth()->user();
?>
@extends('backend.layouts.main')

@section('title') {{ $title }} @endsection

@section('content')
<style>
    .color-green{
        color: green;
    }
    .color-gray{
        color: gray;
    }
</style>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h6> Apex chart </h6>
            </div>
            <div class="card-body">
                <div id="apexStackBar"></div>
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-header">
                <h6> Apex chart </h6>
            </div>
            <div class="card-body">
                <div id="apexColumns"></div>
            </div>
        </div>



        <div class="card mt-5">
            <div class="card-header">
                <h6> Apex chart </h6>
            </div>
            <div class="card-body">
                <div id="model"></div>

                <div class="row text-center">
                    <div class="col-md-6">
                        <div id="chart-year"></div>
                    </div>
                    <div class="col-md-6">
                        <div id="chart-quarter"></div>
                    </div>
                </div>

            </div>
        </div>


    </div>

    <div class="col-md-4">

        <div class="card">
            <div class="card-header">
                <h6> Ai đang online </h6>
            </div>
            <div class="card-body">
                <ul>
                    @foreach($admins as $admin)
                        <li class="is-online color-gray" id="admin-{{$admin->id}}">{{ $admin->name }}</li>
                    @endforeach
                </ul>

            </div>
        </div>

        <div class="card mt-5">
            <div class="card-header">
                <h6> THông báo </h6>
            </div>
            <div class="card-body">

                @can('isAdmin')
                    @foreach($admin->notifications as $notification)
                        <div class="alert alert-info">

                            {{ $notification->data['user_name'] }} tạo mới danh mục
                            <a href="{{ admin_route('categories.show', $notification->data['cate_id']) }}">{{ $notification->data['cate_name'] }}</a>

                            <p class="text-right mb-0">
                                <code>{{ $notification->created_at->diffForHumans() }}</code>
                            </p>
                        </div>
                    @endforeach
                @endcan

                link xem tutorial: https://www.youtube.com/watch?v=IFz7eNQDVkA

            </div>
        </div>

        <div class="card mt-5">
            <div class="card-header">
                <h6> Apex chart </h6>
            </div>
            <div class="card-body">
                <div id="apexDashed"></div>
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-body">
                <h4>Apex Pie</h4>
                <div id="apexPie"></div>
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
    <script src="{{ asset('vendor/charts/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ admin_asset('js/pages/apexchart.js') }}"></script>
@endpush