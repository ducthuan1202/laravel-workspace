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
                    <td class="text-right">
                        <div class="btn-group btn-group-sm" role="group" aria-label="control group" style="margin-right: 7px">

                            <a href="{{ admin_route('categories.show', $item->id) }}" class="btn btn-info"> Xem </a>

                            <a href="{{ admin_route('categories.edit', $item->id) }}" class="btn btn-primary"> Sửa </a>

                            <a href="javascript:void(0);" class="btn btn-danger" onclick="BackendApp.confirmFormDelete('{{'destroyForm_'.$item->id}}');"> Xóa </a>
                        </div>

                        {{ Form::open([ 'url' => admin_route('categories.destroy', $item->id), 'method' => 'POST', 'style'=>'display:none', 'class'=>'d-none', 'id'=> 'destroyForm_'.$item->id])}}
                        @method('DELETE')
                        {{ Form::close() }}

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
