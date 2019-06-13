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
    public function view(Admin $admin, Category $category)
    {
        return (int)$admin->role === Admin::ROLE_ADMIN || (int)$admin->id === (int)$category->created_by;
    }

    /**
     * @param Admin $admin
     * @return bool
     */
    public function create(Admin $admin)
    {
        return (int)$admin->role === Admin::ROLE_ADMIN;
    }

    /**
     * @param Admin $admin
     * @return bool
     */
    public function store(Admin $admin)
    {
        return (int)$admin->role === Admin::ROLE_ADMIN;
    }

    /**
     * @param Admin $admin
     * @param Category $category
     * @return bool
     */
    public function edit(Admin $admin, Category $category)
    {
        return (int)$admin->id === (int)$category->created_by;
    }

    /**
     * @param Admin $admin
     * @param Category $category
     * @return bool
     */
    public function update(Admin $admin, Category $category)
    {
        return (int)$admin->id === (int)$category->created_by;
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
