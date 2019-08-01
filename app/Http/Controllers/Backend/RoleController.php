<?php

namespace App\Http\Controllers\Backend;


use App\Entities\Permission;
use App\Entities\Role;
use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends BackendController
{

    public $model;

    public function __construct(Role $model)
    {
        $this->title = 'Nhóm quyền';
        $this->viewFolder = 'role';
        $this->routePrefix = 'roles';

        $this->model = $model;
    }

    public function index(Request $request)
    {
        return view($this->getView('index'), [
            'title' => sprintf('Danh sách [%s]', $this->title),
            'params' => $request->all(),
            'model' => $this->model,
            'data' => $this->model->search($request->all()),
        ]);
    }

    public function getData(Request $request)
    {

        return response()->json([
            'success' => true,
            'code' => 200,
            'data' => view($this->getView('partials._table'), [
                'params' => $request->all(),
                'model' => $this->model,
                'data' => $this->model->search($request->all()),
            ])->render()
        ]);
    }

    public function openForm(Request $request)
    {
        /** @var Role $model */

        $model = $this->model::firstOrNew(['id' => (int)$request->get('id')]);

        return response()->json([
            'success' => true,
            'data' => view($this->getView('form'), [
                'model' => $model,
                'categories' => $model->list(),
            ])->render()
        ]);
    }

    public function saveForm(RoleRequest $request)
    {
        try {

            $this->model::firstOrNew(['id' => (int)$request->get('id')])->fill($request->all())->save();

            return response()->json(['success' => true, 'data' => 'lưu thành công']);

        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'data' => $exception->getMessage()]);
        }
    }

    public function choosePermissions(Request $request)
    {
        /** @var Role $model */

        $model = $this->model::findOrFail($request->get('id'));

        return response()->json([
            'success' => true,
            'data' => view($this->getView('choose_permissions'), [
                'model' => $model,
                'permissions' => Permission::get(),
            ])->render()
        ]);
    }

    public function savePermissions(Request $request)
    {
        try {
            /** @var Role $model */
            $model = $this->model::findOrFail($request->get('id'));

            DB::table('roles_permissions')
                ->where('role_id', $request->get('id'))
                ->whereIn('role_id', $request->get('permissions'))
                ->delete();
            $model->permissions()->attach($request->get('permissions'));

            return response()->json([
                'success' => true,
                'data' => 'Gán quyền thành công'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'data' => $exception->getMessage(),
            ]);
        }

    }
}
