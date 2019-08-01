<?php
/**
 * @var \App\Entities\Role $model
 * @var \App\Entities\Role[] $data
 */
?>

@extends('backend.layouts.main')

@section('title') {{ $title }} @endsection

@section('content')

    <header class="page-title-bar">

        <button type="button" class="btn btn-success btn-floated" data-function="loadForm">
            <span class="fa fa-plus"></span>
        </button>

        <div class="d-md-flex align-items-md-start">

            <h1 class="page-title mr-sm-auto"> {{ $title }} </h1>

            <div class="btn-toolbar">

                <button type="button" class="btn btn-light">
                    <i class="oi oi-data-transfer-download"></i>
                    <span class="ml-1">Export</span>
                </button>

                <button type="button" class="btn btn-light">
                    <i class="oi oi-data-transfer-upload"></i>
                    <span class="ml-1">Import</span>
                </button>

                <div class="dropdown">
                    <button type="button" class="btn btn-light" data-toggle="dropdown">
                        <span>More</span>
                        <span class="fa fa-caret-down"></span>
                    </button>

                    <div class="dropdown-arrow dropdown-arrow-right"></div>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item">Add tasks</a>
                        <a href="#" class="dropdown-item">Invite members</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">Share</a>
                        <a href="#" class="dropdown-item">Archive</a>
                        <a href="#" class="dropdown-item">Remove</a>
                    </div>

                </div>
            </div>

        </div>

    </header>

    <div class="page-section" id="arena-block-ui">

        <div class="card card-fluid">

            <div class="card-header">
                <div class="d-flex align-items-center">
                    <span class="mr-auto">Bordered</span>
                    <button type="button" class="btn btn-icon btn-light"><i class="fa fa-copy"></i></button>
                    <button type="button" class="btn btn-icon btn-light"><i class="fa fa-download"></i></button>
                </div>
            </div>

            <div class="card-body-s" style="min-height: 300px">
                <div class="table-responsive" id="grid-table-data"></div>
            </div>

        </div>

    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static"></div>

@endsection

@push('scripts')
    <script src="{{ admin_asset('js/pages/tbl-role.js') }}"></script>
    <script>
        const role = new Role();

        /*
        |--------------------------------------------------------------------------
        | Document on ready jquery event
        |--------------------------------------------------------------------------
        */
        $(document).ready(function () {
            role.loadFormUrl = '{{ admin_route('roles.open_form') }}';
            role.saveFormUrl = '{{ admin_route('roles.save_form') }}';
            role.urlGetData = '{{ admin_route('roles.get_data') }}';
            role.urlChoosePermissions = '{{ admin_route('roles.choose_permissions') }}';
            role.urlSavePermissions = '{{ admin_route('roles.save_permissions') }}';

            role.getData();
        })
    </script>
@endpush
