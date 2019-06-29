<?php
/**
 * @var \App\Entities\Product $model
 * @var \App\Entities\Category[] $categories
 */
?>


<div class="modal-dialog modal-xl modal-dialog-centered" role="document">

    <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">From Sản phẩm</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">

            <div class="alert alert-danger d-none" id="ajaxErrors"></div>


            {{ Form::open(['method' => 'POST', 'url' => admin_route('products.store')]) }}

            {{ Form::hidden('id', $model->id) }}



            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" data-hint="name">
                        {{ Form::label('name', 'Tên Sản Phẩm') }}
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                            {{ Form::text('name', old('name') ? old('name') : $model->name, ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" data-hint="price">
                        {{ Form::label('category_id', 'Danh mục') }}
                        {{ Form::select('category_id', $categories->pluck('name', 'id'), old('category_id') ? old('category_id') : $model->category_id, ['class' => 'form-control select2']) }}
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" data-hint="name">
                        {{ Form::label('price', 'Giá bán') }}
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                            {{ Form::text('price', old('price') ? old('price') : $model->price, ['class' => 'form-control inp-currency']) }}
                            <div class="input-group-append"><span class="input-group-text">vnđ</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h5>Tùy chọn</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="custom-control custom-switch">
                                {{ Form::checkbox('is_feature', $model::IS_FEATURE, $model->is_feature, ['class' => 'custom-control-input', 'id'=> 'is_feature' ]) }}
                                {{ Form::label('is_feature', 'Nổi bật', ['class'=> 'custom-control-label']) }}
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="custom-control custom-switch">
                                {{ Form::checkbox('status', $model::STATUS_ACTIVATE, $model->status, ['class' => 'custom-control-input', 'id'=> 'status' ]) }}
                                {{ Form::label('status', 'Hoạt động', ['class'=> 'custom-control-label']) }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{ Form::close() }}
        </div>

        <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Đóng form </button>
            <button type="button" class="btn btn-primary" data-function="saveForm"> Lưu thông tin </button>

            @if($model->exists)
                <a href="javascript:void(0)" class="btn btn-danger" data-function="destroy" data-href="{{ admin_route('products.destroy', $model) }}">
                    Xóa
                </a>
            @endif
        </div>

    </div>
</div>



