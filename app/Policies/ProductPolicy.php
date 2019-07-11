<?php

namespace App\Policies;

use App\Admin;
use App\Entities\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * @param Admin $admin
     * @param Product $product
     * @return bool
     */
    public function isAuthor(Admin $admin, Product $product)
    {
        return (int)$admin->id === (int)$product->created_by || (int) $admin->role === Admin::ROLE_ADMIN;
    }

}
