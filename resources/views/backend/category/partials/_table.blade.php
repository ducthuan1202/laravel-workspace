<?php
/**
 * @var \Illuminate\Pagination\LengthAwarePaginator $data
 * @var \App\Entities\Category $model
 * @var \App\Entities\Category $item
 */
?>
<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead>
        <tr>
            <th>#</th>
            <th>Tên</th>
            <th>Ngày tạo</th>
            <th>Trạng thái</th>
            <th>Người tạo</th>
            <th> &nbsp; </th>
        </tr>
        </thead>
        <tbody>

        @if($data->isNotEmpty())

            @foreach($data as $index => $item)
                <tr>
                    <td>{{ $index + $data->firstItem() }}</td>

                    <td>
                        <a href="{{ admin_route('categories.edit', $item->id) }}"> <b>{{ $item->name }}</b> </a>
                    </td>
                    <td>
                        {{ $item->created_at }}
                    </td>
                    <td>
                        {{ $item->updated_at ? 'đã sửa' : 'chưa sửa' }}
                    </td>
                    <td>
                        {{ $item->formatCreatedBy() }}
                    </td>
                    <td class="text-right">
                        @can('isAuthor', $item)
                            <div class="btn-group btn-group-sm" role="group" aria-label="control group" style="margin-right: 7px">

                                <a href="{{ admin_route('categories.show', $item->id) }}" class="btn btn-info"> Xem </a>

                                <a href="{{ admin_route('categories.edit', $item->id) }}" class="btn btn-primary"> Sửa </a>

                                <a href="javascript:void(0);" class="btn btn-danger" onclick="confirmFormDelete('{{'df_'.$item->id}}', true);"> Xóa </a>

                            </div>

                            {{ Form::open([ 'url' => admin_route('categories.destroy', $item->id), 'method' => 'POST', 'style'=>'display:none', 'id'=> 'df_'.$item->id]) }}
                                @method('DELETE')
                            {{ Form::close() }}
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
