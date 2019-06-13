<?php

namespace App\Providers;

use App\Admin;
use App\Entities\Category;
use App\Policies\CategoryPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         Category::class => CategoryPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // quyền admin
        Gate::define('isAdmin', function(Admin $admin){
            return (int)$admin->role === Admin::ROLE_ADMIN;
        });

        // quyền role
        Gate::define('isMember', function(Admin $admin){
            return (int)$admin->role === Admin::ROLE_MEMBER;
        });

    }
}
