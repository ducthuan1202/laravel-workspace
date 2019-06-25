<?php
/**
 * @var \Illuminate\Pagination\LengthAwarePaginator $data
 * @var \App\Entities\Product $model
 * @var \App\Entities\Product $item
 */
?>
<div class="table-responsive">
    <table class="table table-hover align-middle" id="gridDataTable">
        <thead>
        <tr>
            <th>#</th>
            <th>Tên</th>
            <th>Ngày tạo</th>
            <th>Nổi bật</th>
            <th>Trạng thái</th>
            <th> &nbsp; </th>
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
                        @can('isAuthor', $item)
                            <div class="btn-group btn-group-sm" role="group" aria-label="control group" style="margin-right: 7px">

                                <a href="{{ admin_route('products.show', $item->id) }}" class="btn btn-info"> Xem </a>

                                <a href="{{ admin_route('products.edit', $item->id) }}" class="btn btn-primary"> Sửa </a>

                                <a href="javascript:void(0);" class="btn btn-danger" onclick="confirmFormDelete('{{'df_'.$item->id}}', true);"> Xóa </a>

                            </div>

                        @endcan

                        @cannot('isAuthor', $item)
                            <span class="btn btn-secondary btn-sm disabled" style="margin-right: 7px; width: 125px"> No permission </span>
                        @endcannot
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
</div>
