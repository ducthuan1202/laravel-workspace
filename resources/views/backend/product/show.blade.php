<?php
/**
 * @var \App\Entities\Product $model
 */
?>

@extends('backend.layouts.main')

@section('title') {{ $title }} @endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <h6>
                {{ $title }}
                <a href="{{ admin_route('products.edit', $model) }}" class="btn btn-info float-right btn-sm">Chỉnh sửa</a>
            </h6>
        </div>
        <div class="card-body-custom">

            <div class="table-responsive">
                <table class="table">
                    <colgroup>
                        <col style="width: 30%">
                        <col style="width: 70%">
                    </colgroup>
                    <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{ $model->id }}</td>
                    </tr>
                    <tr>
                        <th>Tên</th>
                        <td>{{ $model->name }}</td>
                    </tr>

                    <tr>
                        <th>Thời gian tạo</th>
                        <td>{{ $model->created_at }}</td>
                    </tr>
                    <tr>
                        <th>Cập nhật lần cuối</th>
                        <td>{{ $model->updated_at }}</td>
                    </tr>

                    <tr>
                        <th colspan="2" class="text-center" style="padding-top: 30px">
                            <a href="{{ admin_route('products.index') }}" class="btn btn-dark">Quay lại danh sách</a>
                            <a href="{{ admin_route('products.edit', $model) }}" class="btn btn-primary">Chỉnh sửa</a>
                        </th>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>



@endsection
