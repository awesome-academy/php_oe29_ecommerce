<?php

namespace Tests\Browser;

use App\Models\Product;
use App\Models\User;
use Tests\DuskTestCase;

class ProductTest extends DuskTestCase
{

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_view_Detail_product_in_english()
    {
        $this->browse(function ($browser) {
            $product = Product::find(1);
            $browser->loginAs(User::find(6))
                ->visit('/admin/manage-product/manage-product/products/' . $product->id)
                ->assertSee('Language')
                ->click('@language')
                ->assertSee('English')
                ->assertSee('Vietnamese')
                ->clicklink('English')
                ->assertSee('Admin Shoes')
                ->assertSee('Website')
                ->assertSee('Dashboard')
                ->assertSee('User Management')
                ->assertSee('Product Management')
                ->assertSee('Product')
                ->assertSee('Category')
                ->assertSee('Brand')
                ->assertSee('Order Management')
                ->assertSee('Supplier Management')
                ->assertSee('Description')
                ->assertSee('Image')
                ->assertSee('List size')
                ->assertSee('Give a comment')
                ->assertSee('Name brand')
                ->assertSee($product->brand->name)
                ->assertSee('Category')
                ->assertSee($product->category->name)
                ->assertSee('Rate')
                ->assertSee('Quantity')
                ->assertSee($product->productDetails->sum('quantity'))
                ->assertSee(strip_tags($product->description)); // Vì description của em có cả thẻ p
        });
    }

    public function test_view_Product_Detail_in_VietNamese()
    {
        $this->browse(function ($browser) {
            $product = Product::find(1);
            $browser->loginAs(User::find(6))
                ->visit('/admin/manage-product/manage-product/products/' . $product->id)
                ->assertSee('Language')
                ->click('@language')
                ->assertSee('English')
                ->assertSee('Vietnamese')
                ->clicklink('Vietnamese')
                ->assertSee('Admin Shoes')
                ->assertSee('Trang chủ')
                ->assertSee('Bảng điều khiển')
                ->assertSee('Quản lí người dùng')
                ->assertSee('Quản lí sản phẩm')
                ->assertSee('Sản phẩm')
                ->assertSee('Danh mục')
                ->assertSee('Nhãn hiệu')
                ->assertSee('Quản lí đơn hàng')
                ->assertSee('Quản lí nhà cung cấp')
                ->assertSee('Mô tả')
                ->assertSee('Hình ảnh')
                ->assertSee('danh sách size')
                ->assertSee('Tổng quan đánh giá')
                ->assertSee('Tên nhãn hiệu')
                ->assertSee($product->brand->name)
                ->assertSee('Tên danh mục')
                ->assertSee($product->category->name)
                ->assertSee('Đánh giá')
                ->assertSee('Số lượng')
                ->assertSee($product->productDetails->sum('quantity'))
                ->assertSee(strip_tags($product->description));
        });
    }

    public function test_action_website()
    {
        $this->browse(function ($website) {
            $product = Product::find(1);
            $user = User::find(6);
            $website->loginAs($user)
                ->visit('/admin/manage-product/manage-product/products/' . $product->id)
                ->assertSee('Ngôn ngữ')
                ->click('@language')
                ->assertSee('Tiếng Anh')
                ->assertSee('Tiếng Việt')
                ->clicklink('Tiếng Anh')
                ->assertSee('Website')
                ->clicklink('Website')
                ->assertPathIs('/');
        });
    }

    public function test_action_website_Order()
    {
        $this->browse(function ($website) {
            $product = Product::find(1);
            $user = User::find(6);
            $website->loginAs($user)
                ->visit('/admin/manage-product/manage-product/products/' . $product->id)
                ->assertSee('Language')
                ->click('@language')
                ->assertSee('English')
                ->assertSee('Vietnamese')
                ->clicklink('English')
                ->assertSee('Order Management')
                ->clicklink('Order Management')
                ->assertPathIs('/admin/manage-product/manage-order/orders');
        });
    }

    public function test_action_website_Supplier()
    {
        $this->browse(function ($website) {

            $product = Product::find(1);
            $user = User::find(6);
            $website->loginAs($user)
                ->visit('/admin/manage-product/manage-product/products/' . $product->id)
                ->assertSee('Language')
                ->click('@language')
                ->assertSee('English')
                ->assertSee('Vietnamese')
                ->clicklink('English')
                ->assertSee('Supplier Management')
                ->clicklink('Supplier Management')
                ->assertPathIs('/admin/manage-product/manage-supplier/suppliers');
        });
    }

    public function test_action_website_category()
    {
        $this->browse(function ($website) {

            $product = Product::find(1);
            $user = User::find(6);
            $website->loginAs($user)
                ->visit('/admin/manage-product/manage-product/products/' . $product->id)
                ->assertSee('Language')
                ->click('@language')
                ->assertSee('English')
                ->assertSee('Vietnamese')
                ->clicklink('English')
                ->assertSee('Product Management')
                ->clicklink('Product Management')
                ->assertSee('Category')
                ->clicklink('Category')
                ->assertPathIs('/admin/manage-product/categories');
        });
    }

    public function test_action_website_brand()
    {
        $this->browse(function ($website) {

            $product = Product::find(1);
            $user = User::find(6);
            $website->loginAs($user)
                ->visit('/admin/manage-product/manage-product/products/' . $product->id)
                ->assertSee('Language')
                ->click('@language')
                ->assertSee('English')
                ->assertSee('Vietnamese')
                ->clicklink('English')
                ->assertSee('Product Management')
                ->clicklink('Product Management')
                ->assertSee('Brand')
                ->clicklink('Brand')
                ->assertPathIs('/admin/manage-product/brands');
        });
    }

    public function test_action_website_list_product()
    {
        $this->browse(function ($website) {
            $product = Product::find(1);
            $user = User::find(6);
            $website->loginAs($user)
                ->visit('/admin/manage-product/manage-product/products/' . $product->id)
                ->assertSee('Language')
                ->click('@language')
                ->assertSee('English')
                ->assertSee('Vietnamese')
                ->clicklink('English')
                ->assertSee('Product Management')
                ->clicklink('Product Management')
                ->assertSee('List Product')
                ->clicklink('List Product')
                ->assertPathIs('/admin/manage-product/manage-product/products');
        });
    }

    public function test_action_delete_images()
    {
        $this->browse(function ($website) {
            $product = Product::find(1);
            $user = User::find(6);
            $website->loginAs($user)
                ->visit('/admin/manage-product/manage-product/products/' . $product->id)
                ->assertSee('Language')
                ->click('@language')
                ->assertSee('English')
                ->assertSee('Vietnamese')
                ->clicklink('English')
                ->assertSee('Image')
                ->clicklink('Image')
                ->assertPresent('#delete-image')
                ->click()
                ->assertPathIs('/admin/manage-product/manage-product/products/' . $product->id);
        });
    }

    public function test_action_page_logout()
    {
        $this->browse(function ($website) {
            $product = Product::find(1);
            $user = User::find(6);
            $website->loginAs($user)
                ->visit('/admin/manage-product/manage-product/products/' . $product->id)
                ->assertSee('Language')
                ->click('@language')
                ->assertSee('English')
                ->assertSee('Vietnamese')
                ->clicklink('English')
                ->click('@logout')
                ->assertSee('Logout')
                ->clicklink('Logout')
                ->assertPathIs('/');
        });
    }
}
