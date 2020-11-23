<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use App\Models\Product;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        view()->composer(['users.components.homes.introduce_product_component'], function ($view) {
            $product = Product::whereColumn('original_price', '>', 'current_price')->first();
            $view->with('product', $product);
        });
    }
}
