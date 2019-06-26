<?php

namespace App\Scopes;

use App\Admin;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class OwnerScope implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
        /** @var Admin $admin */
        $admin = auth()->user();
        if ($admin) {
            if (!((int)$admin->role === Admin::ROLE_ADMIN)) {
                $builder->where('created_by', auth()->id());
            }
        }
    }
}
