<?php

namespace App\Providers;

use App\Models\Comment;
use App\Policies\CommentPolicy;
use App\Policies\SupplierPolicy;
use App\Policies\CategoryPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Supplier;
use App\Models\Category;
use App\Policies\ProductPolicy;
use App\Models\Product;
use App\Policies\OrderPolicy;
use App\Models\Order;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Supplier::class => SupplierPolicy::class,
        Comment::class => CommentPolicy::class,
        Category::class => CategoryPolicy::class,
        Product::class => ProductPolicy::class,
        Order::class => OrderPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
