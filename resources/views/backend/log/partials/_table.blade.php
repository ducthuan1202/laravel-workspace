<?php
/**
 * @var \Illuminate\Pagination\LengthAwarePaginator $data
 * @var \App\Entities\Log $item
 */
?>
<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Tên</th>
            <th>Hành động</th>
            <th>Chi tiết</th>
            <th>Thời gian</th>
            <th> &nbsp; </th>
        </tr>
        </thead>
        <tbody>

        @if($data->isNotEmpty())

            @foreach($data as $index => $item)
                <tr>
                    <td>{{ $index + $data->firstItem() }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->action }}</td>
                    <td>{!! $item->content !!}</td>
                    <td>{{ $item->created_at }}</td>
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
