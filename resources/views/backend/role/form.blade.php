<?php
/**
 * @var \App\Entities\Role $model
 * @var string $title
 */
?>
<div class="modal-dialog modal-xl" role="document">

    <div class="modal-content">

        <div class="modal-header border-bottom">
            <h5 class="modal-title">Nhóm quyền</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="big-icon-close-modal">&times;</span>
            </button>
        </div>

        <div class="modal-body">

            <div class="alert alert-danger d-none" id="ajaxErrors"></div>

            {{ Form::open(['method' => 'POST', 'url' => admin_route('roles.save_form')]) }}

            {{ Form::hidden('id', $model->id) }}

            <div class="form-group" data-hint="name">
                {{ Form::label('name', 'Tên Nhóm Quyền') }}
                <div class="input-group">
                    {{ Form::text('name', old('name', $model->name), ['class' => 'form-control']) }}
                </div>
            </div>

            <div class="form-group" data-hint="description">
                {{ Form::label('description', 'Mô tả') }}
                <div class="input-group">
                    {{ Form::textarea('description', old('description', $model->description), ['class' => 'form-control']) }}
                </div>
            </div>

            {{ Form::close() }}
        </div>

        <div class="modal-footer justify-content-center border-top">

            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Đóng form</button>
            <button type="button" class="btn btn-primary" data-function="saveForm"> <i class="fa fa-save"></i> Lưu thông tin</button>

        </div>

    </div>
</div>
