<?php

namespace App\Providers;

use App\Entities\Category;
use App\Entities\Product;
use App\Observers\CategoryObserver;
use App\Observers\ProductObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Schema::defaultStringLength(191);

        // register observe Category Model
        Category::observe(CategoryObserver::class);

        // register observe Product Model
        Product::observe(ProductObserver::class);
    }
}
