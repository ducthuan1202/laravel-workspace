<?php
/**
 * @var \App\Entities\Category $model
 * @var \App\Entities\Category $item
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

            <div class="table-responsive">
                <table class="table">
                    <colgroup>
                        <col style="width: 30%">
                        <col style="width: 70%">
                    </colgroup>
                    <tbody>
                    <tr>
                        <th>Người Tạo</th>
                        <td>{!! $model->formatHtmlCreatedBy() !!}</td>
                    </tr>
                    <tr>
                        <th>Tên</th>
                        <td>{{ $model->name }}</td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td>{{ $model->slug }}</td>
                    </tr>
                    <tr>
                        <th>Image</th>
                        <td>{{ $model->image }}</td>
                    </tr>
                    <tr>
                        <th>Trạng thái</th>
                        <td>{{ $model->formatIsActivate() }}</td>
                    </tr>
                    <tr>
                        <th>Thời gian tạo</th>
                        <td>{{ $model->created_at }}</td>
                    </tr>
                    <tr>
                        <th>Cập nhật lần cuối</th>
                        <td>{{ $model->updated_at ? $model->updated_at : 'chưa cập nhận lần nào' }}</td>
                    </tr>

                    <tr>
                        <th colspan="2" class="text-center" style="padding-top: 30px">
                            <a href="{{ admin_route('categories.index') }}" class="btn btn-dark">Quay lại danh sách</a>
                            <a href="{{ admin_route('categories.edit', $model) }}" class="btn btn-primary">Chỉnh sửa</a>
                        </th>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>



@endsection
