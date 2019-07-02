<?php
/**
 * @var \Illuminate\Pagination\LengthAwarePaginator $data
 * @var \App\Entities\Log $item
 */
?>
<div class="table-responsive">
    <table class="table mb-0">
        <thead>
        <tr>
            <th>Hành động</th>
            <th>Tên</th>
            <th>Chi tiết</th>
            <th>Thời gian</th>
        </tr>
        </thead>
        <tbody>

        @if($data->isNotEmpty())

            @foreach($data as $index => $item)
                <tr style="background-color: {{ $item->formatClassLog() }}">
                    <td>{{ $item->formatAction() }}</td>
                    <td>{{ $item->name }}</td>
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
