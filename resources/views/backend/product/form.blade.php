<?php
/**
 * @var \App\Entities\Product $model
 * @var \App\Entities\Category[] $categories
 */
?>


<div class="modal-dialog modal-xl" role="document">

    <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">From Sản phẩm</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">

            {{ Form::open(['method' => 'POST', 'url' => admin_route('products.store')]) }}

            @if($model->exists) @method('PATCH') @endif

            <div class="alert alert-danger d-none" id="ajaxErrors"></div>

            <div class="form-group" data-hint="name">
                {{ Form::label('name', 'Tên Sản Phẩm') }}
                {{ Form::text('name', old('name') ? old('name') : $model->name, ['class' => 'form-control']) }}
            </div>

            <div class="form-group" data-hint="price">
                {{ Form::label('price', 'Giá bán') }}
                {{ Form::number('price', old('price') ? old('price') : $model->price, ['class' => 'form-control']) }}
            </div>

            <div class="form-group" data-hint="price">
                {{ Form::label('category_id', 'Giá bán') }}
                {{ Form::select('category_id', $categories->pluck('name', 'id'), old('category_id') ? old('category_id') : $model->category_id, ['class' => 'form-control']) }}
            </div>

            <div class="custom-control custom-checkbox" data-hint="is_feature">
                {{ Form::checkbox('is_feature', $model->is_feature, null, ['class' => 'custom-control-input', 'id'=> 'is_feature' ]) }}
                {{ Form::label('is_feature', 'Nổi bật', ['class'=> 'custom-control-label']) }}
            </div>

            {{ Form::close() }}
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Đóng form </button>
            <button type="button" class="btn btn-primary" data-function="saveForm"> Lưu thông tin </button>
        </div>

    </div>
</div>



