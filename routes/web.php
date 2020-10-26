<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'localization'], function() {
    Route::get('lang/{language}', 'LocalizationController@changeLanguage')->name('localization');
    Route::name('user.')->group(function() {
        Route::get('login', 'LoginController@getLogin')->name('getLogin');
        Route::post('login', 'LoginController@postLogin')->name('postLogin');
        Route::get('logout', 'LoginController@logout')->name('logout');
        Route::get('register', 'RegisterController@getRegister')->name('getRegister');
        Route::post('register', 'RegisterController@postRegister')->name('postRegister');
        Route::get('/', 'HomeController@home')->name('home');
        Route::get('product', 'ProductController@index')->name('product');
        Route::get('product/{id}', 'ProductController@show')->name('product.show');
        Route::get('product/filter-by-category/{id}', 'ProductController@getProductByCategory')->name('product.filter_by_category');
        Route::get('about', 'HomeController@home')->name('about');
        Route::get('contact', 'HomeController@home')->name('contact');
        Route::get('cart', 'HomeController@home')->name('cart');
        Route::get('quantity/{id}', 'ProductController@quantity')->name('quantity');
        Route::patch('change-password', 'HomeController@changePassword')->name('change_password');
        Route::patch('change-information', 'HomeController@changeInformation')->name('change_information');
        Route::post('add-to-cart', 'CartController@add')->name('addToCart');
        Route::get('cart', 'CartController@cart')->name('cart');
        Route::post('delete-one-product', 'CartController@deleteOneProduct')->name('deleteOne');
        Route::get('delete-all-product', 'CartController@deleteAllProduct')->name('deleteAll');
        Route::group(['middleware' => 'checkLogin'], function(){
            Route::get('checkout', 'OrderController@getListItemsInCart')->name('listItemInCart');
            Route::post('checkout', 'OrderController@checkout')->name('checkout');
            Route::get('order-history', 'OrderController@getOrderHistory')->name('orderHistory');
            Route::get('order-history-by-status', 'OrderController@getOrderHistoryByStatus')->name('orderHistoryByStatus');
        });
        Route::post('comment/product/{id}', 'ProductController@comment')->name('comment');
        Route::post('reply-comment/{commentId}/product/{productId}', 'ProductController@replyComment')->name('reply_comment');
        Route::get('delete-comment/{id}', 'ProductController@deleteComment')->name('delete_comment');
    });
    Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
        Route::get('/', 'DashboardController@index')->name('admin.dashboard');
        Route::group(['prefix' => 'manage-product', 'middleware' => 'role:' . config('role.admin.product')], function () {
            Route::resource('products', 'ProductController')->names('products');
            Route::delete('delete-image/{id}', 'ProductController@deleteImage')->name('delete.image');
            Route::delete('delete-comment/{id}', 'ProductController@deleteComment')->name('delete.comment');
            Route::delete('delete-productDetail/{id}', 'ProductController@deleteProductDetail')->name('delete.productDetail');
        });
        Route::group(['prefix' => 'manage-order', 'middleware' => 'role:' . config('role.admin.order')], function () {
            Route::resource('orders', 'OrderController')->names('orders');
            Route::patch('order/{id}/approved', 'OrderController@approvedOrder')->name('orders.approved');
            Route::patch('order/{id}/rejected', 'OrderController@rejectedOrder')->name('orders.rejected');
        });
        Route::group(['prefix' => 'manage-supplier', 'middleware' => 'role:' . config('role.admin.supplier')], function () {
           Route::resource('suppliers', 'SupplierController')->names('suppliers');
           Route::get('import-product/{id}', 'SupplierController@showProduct')->name('import.product');
           Route::get('view-modal/product/{productId}/supplier/{supplierId}', 'SupplierController@showInfoProduct')->name('show.modal');
           Route::post('import-product/{id}', 'SupplierController@updateOrCreateProductDetails')->name('action.import');
        });
        Route::resource('brands', 'BrandController')->except(['create', 'show', 'edit']);
    });
});
