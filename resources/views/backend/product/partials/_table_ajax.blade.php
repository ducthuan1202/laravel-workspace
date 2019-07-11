<?php
/**
 * @var \Illuminate\Pagination\LengthAwarePaginator $data
 * @var \App\Entities\Product $model
 * @var \App\Entities\Product $item
 */
?>

<table class="table table-hover mb-0 tableFixHead align-middle">
    <thead>
        <tr>
            <th class="bg-light"></th>
            <th class="bg-light">Tên sản phẩm</th>
            <th class="bg-light">Ngày tạo</th>
            <th class="bg-light">Đánh đấu nổi bật</th>
            <th class="bg-light">Trạng thái sản phẩm</th>
            <th class="bg-light text-right">Người tạo</th>
        </tr>
    </thead>
    <tbody>

        @if($data->isNotEmpty())
            @foreach($data as $index => $item)
                <tr class="context-menu-one">
                    <td>{{ $index + $data->firstItem() }}</td>

                    <td>
                        <a href="javascript:void(0)" data-function="loadForm" data-id="{{$item->id}}">
                            {{ $item->name }}
                        </a>
                    </td>
                    <td class="status-menu">
                        {{ $item->formatCreatedAt() }}
                    </td>
                    <td>
                        {!! $item->formatFeature() !!}
                    </td>
                    <td>
                        {{ $item->formatStatus() }}
                    </td>
                    <td class="text-right">
                        <a href="javascript:void(0)">{!! $item->formatCreatedBy() !!}</a>
                    </td>
                </tr>

            @endforeach
        @else
            <tr>
                <td colspan="100">
                    <p>Không có dữ liệu.</p>
                </td>
            </tr>
        @endif
        </tbody>
    </table>

<div class="">
    @include('backend.layouts.partials.paginate')
</div>

