<?php

namespace App\Providers;

use App\Repositories\Comment\CommentRepository;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Brand\BrandRepository;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Image\ImageRepositoryInterface;
use App\Repositories\Image\ImageRepository;
use App\Repositories\ProductDetails\ProductDetailRepositoryInterface;
use App\Repositories\ProductDetails\ProductDetailRepository;
use App\Repositories\Supplier\SupplierRepositoryInterface;
use App\Repositories\Supplier\SupplierRepository;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Order\OrderRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );

        $this->app->singleton(
            BrandRepositoryInterface::class,
            BrandRepository::class
        );

        $this->app->singleton(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        $this->app->singleton(
            ImageRepositoryInterface::class,
            ImageRepository::class
        );

        $this->app->singleton(
            ProductDetailRepositoryInterface::class,
            ProductDetailRepository::class
        );

        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->singleton(

            SupplierRepositoryInterface::class,
            SupplierRepository::class
        );

        $this->app->singleton(
            OrderRepositoryInterface::class,
            OrderRepository::class
        );

        $this->app->singleton(
            CommentRepositoryInterface::class,
            CommentRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
