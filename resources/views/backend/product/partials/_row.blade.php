<?php
/**
 * @var \App\Entities\Product $model
 */
?>

<tr>
    <td> </td>
    <td>
        <a href="{{ admin_route('products.edit', $model->id) }}"> <b>{{ $model->name }}</b> </a>
    </td>
    <td>
        {{ $model->created_at }}
    </td>
    <td>
        {{ $model->is_feature }}
    </td>
    <td>
        {{ $model->updated_at ? 'đã sửa' : 'chưa sửa' }}
    </td>
    <td class="text-right">
        @can('isAuthor', $model)
            <div class="btn-group btn-group-sm" role="group" aria-label="control group" style="margin-right: 7px">

                <a href="{{ admin_route('products.show', $model->id) }}" class="btn btn-info"> Xem </a>

                <a href="{{ admin_route('products.edit', $model->id) }}" class="btn btn-primary"> Sửa </a>

                <a href="javascript:void(0);" class="btn btn-danger" onclick="confirmFormDelete('{{'df_'.$model->id}}', true);"> Xóa </a>

            </div>

            {{ Form::open([ 'url' => admin_route('products.destroy', $model->id), 'method' => 'POST', 'style'=>'display:none', 'id'=> 'df_'.$model->id]) }}
                @method('DELETE')
            {{ Form::close() }}
        @endcan

        @cannot('isAuthor', $model)
            <span class="btn btn-secondary btn-sm disabled" style="margin-right: 7px; width: 125px"> No permission </span>
        @endcannot
    </td>
</tr>
