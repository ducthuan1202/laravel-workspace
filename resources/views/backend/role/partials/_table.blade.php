<?php
/**
 * @var \Illuminate\Pagination\LengthAwarePaginator $data
 * @var \App\Entities\Role $model
 * @var \App\Entities\Role $item
 */
?>

<table class="table">

    <thead>
    <tr>
        <th>
            <span>Tên danh mục</span>
        </th>
        <th>Trạng thái</th>
        <th></th>
    </tr>
    </thead>

    <tbody>

    @if($data->isNotEmpty())

        @foreach($data as $index => $item)

            <tr>
                <td class="align-middle">
                    <a href="javascript:void(0)" data-function="loadForm" data-id="{{$item->id}}"> {{ $item->name }} </a>
                </td>

                <td class="align-middle">
                    {{ $item->description }}
                </td>
                <td class="text-right">
                    <button class="btn btn-primary btn-choose-permissions" data-id="{{ $item->id }}"> <i class="fa fa-users-cog"></i> Gán quyền</button>
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
