<?php

namespace App\Policies;

use App\Admin;
use App\Entities\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;


    /**
     * @param Admin $admin
     * @param Category $category
     * @return bool
     */
    public function isAuthor(Admin $admin, Category $category)
    {
        return (int)$admin->id === (int)$category->created_by || (int) $admin->role === Admin::ROLE_ADMIN;
    }

    /**
     * @param Admin $admin
     * @param Category $category
     * @return bool
     */
    public function delete(Admin $admin, Category $category)
    {
        return (int)$admin->role === Admin::ROLE_ADMIN || (int)$admin->id === (int)$category->created_by;
    }

}
