<?php
/**
 * @var \Illuminate\Pagination\LengthAwarePaginator $data
 * @var \App\Entities\Product $model
 * @var \App\Entities\Product $item
 */
?>

<table class="table table-hover align-middle mb-0">
        <thead>
        <tr>
            <th>#</th>
            <th>Tên</th>
            <th>Ngày tạo</th>
            <th>Nổi bật</th>
            <th>Trạng thái</th>
            <th class="text-right">Người tạo</th>
        </tr>
        </thead>
        <tbody>

        @if($data->isNotEmpty())

            @foreach($data as $index => $item)

                <tr>
                    <td>{{ $index + $data->firstItem() }}</td>

                    <td>
                        <a href="javascript:void(0)" data-function="loadForm" data-id="{{$item->id}}">
                            {{ $item->name }}
                        </a>
                    </td>
                    <td>
                        {{ $item->formatCreatedAt() }}
                    </td>
                    <td>
                        {{ $item->formatFeature() }}
                    </td>
                    <td>
                        {{ $item->formatStatus() }}
                    </td>
                    <td class="text-right">
                        <a href="javascript:void(0)">{{ $item->formatCreatedBy() }}</a>
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

@include('backend.layouts.partials.paginate')
