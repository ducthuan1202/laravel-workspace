<?php
/**
 * @var \App\Entities\Teacher $model
 * @var \App\Entities\Course $item
 */
?>

@extends('backend.layouts.main')

@section('title') {{ $title }} @endsection

@section('content')

    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ $title }} <small>Chi tiết</small></h2>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">

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
                                <th>Giảng viên</th>
                                <td>{{ $model->name }}</td>
                            </tr>
                            <tr>
                                <th>Tiểu sử</th>
                                <td>
                                    <div class="well">
                                        {!! $model->biography !!}
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Trạng thái</th>
                                <td>{{ $model->formatStatus() }}</td>
                            </tr>
                            <tr>
                                <th>Số học viên</th>
                                <td>{{ $model->total_students }}</td>
                            </tr>
                            <tr>
                                <th>Số khóa học</th>
                                <td>{{ $model->total_courses }}</td>
                            </tr>
                            <tr>
                                <th>Số lượt đánh giá</th>
                                <td>{{ $model->total_votes }}</td>
                            </tr>
                            <tr>
                                <th>Tỉ lệ đánh giá</th>
                                <td>{{ $model->avg_rate }}</td>
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
                                    <a href="{{ admin_route('teachers.index') }}" class="btn btn-default">Quay lại danh sách</a>
                                    <a href="{{ admin_route('teachers.edit', $model->id) }}" class="btn btn-primary">Chỉnh sửa</a>
                                </th>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
        <div class="col-md-6 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        Giảng dạy <small>({{ $model->courses->count() }} khóa học)</small>
                    </h2>
                    <div class="clearfix"></div>

                </div>

                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                            <tr>
                                <th>Khóa học</th>
                                <th class="text-center">Lượt mua</th>
                                <th class="text-right">Giá</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if($model->courses->count())

                                @foreach($model->courses as $index => $item)
                                    <tr>
                                        <td class="text-truncate"><a href="{{ admin_route('courses.show', $item->id) }}"> {{ $item->name }} </a></td>
                                        <td class="text-center">{{ $item->total_sales }}</td>
                                        <td class="text-right">
                                            {!! $item->formatPrice() !!} <br/>
                                            {!! $item->formatPriceSale() !!}
                                        </td>
                                    </tr>

                                @endforeach
                            @else
                                @include('backend.layouts.partials.data-not-found')
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
