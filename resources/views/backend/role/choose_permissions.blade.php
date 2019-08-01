<?php
/**
 * @var \App\Entities\Permission[] $permissions
 * @var \App\Entities\Permission[] $myPermissions
 * @var \App\Entities\Role $model
 */
$permissionsName = config('custom.permissions');
$myPermissions = $model->permissions->pluck('id')->toArray();
?>

<div class="modal-dialog modal-xl" role="document" style="max-width: 90%!important;">

    <div class="modal-content">

        <div class="modal-header border-bottom">
            <h5 class="modal-title">Gán quyền cho role #{{ $model->name }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="big-icon-close-modal">&times;</span>
            </button>
        </div>

        <div class="modal-body">

            <div class="alert alert-danger d-none" id="ajaxErrors"></div>

            <div class="form-group mt-3">
                <div class="custom-control custom-control-inline custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="checked-all">
                    <label class="custom-control-label" for="checked-all">Chọn tất cả {{ $permissions->count() }} quyền</label>
                </div>
            </div>

            <hr class="mb-3 mt-3"/>

            {{ Form::open(['method' => 'POST', 'url' => admin_route('roles.save_permissions')]) }}

            {{ Form::hidden('id', $model->id) }}

            @foreach ($permissions->chunk(4) as $permission)
                <div class="row">
                    @foreach ($permission as $perm)

                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="custom-control custom-control-inline custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" value="{{$perm->id}}"
                                           name="permissions[]" id="{{$perm->id}}" {{in_array($perm->id, $myPermissions) ? 'checked' : '' }}/>
                                    <label class="custom-control-label" for="{{$perm->id}}">{{ \Illuminate\Support\Arr::get($permissionsName, $perm->name, $perm->name) }}</label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach

            {{ Form::close() }}
        </div>

        <div class="modal-footer justify-content-center border-top">


            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Đóng form</button>
            <button type="button" class="btn btn-primary btn-save-permissions"> <i class="fa fa-save"></i> Lưu thông tin</button>
        </div>

    </div>
</div>
