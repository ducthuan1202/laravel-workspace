<?php

namespace App\Http\Middleware;

use App\Admin;
use App\Entities\Role;
use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        /** @var Admin $userLogin */
        $userLogin = auth()->guard('admin')->user();

        if($userLogin->is_super_admin){
            return $next($request);
        }

        /**
         * middleware này chỉ áp dụng cho router trong backend,
         * nên không cần check route ngoài frontend
         */

        /** @var mixed|void $permissions */

        $permissions = $this->hasPermissions();
        $action = Route::getCurrentRoute()->getAction();

        if ($permissions->has(Arr::get($action, 'as'))) {
            return $next($request);
        }

        abort(403, '3. bạn không được cấp quyền thực hiện hành động này');
    }

    protected function hasPermissions()
    {
        /** @var Admin $userLogin */
        $userLogin = auth()->guard('admin')->user();

        /** @var Role $role */
        $role = $userLogin->role;
        if (!$role || !($role instanceof Role)) {
            return abort(403, '1. bạn không được cấp quyền thực hiện hành động này');
        }

        $permissions = $role->permissions;
        if ($permissions->isEmpty()) {
            return abort(403, '2. bạn không được cấp quyền thực hiện hành động này');
        }

        $permissions = $permissions->pluck('controller', 'name');


        return $permissions;
    }
}
