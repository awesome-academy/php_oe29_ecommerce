<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Product;
use App\Models\User;

class ProductDetailTest extends DuskTestCase
{
    public function test_view_product_detail_english()
    {
        $this->browse(function ($browser) {
            $product = Product::find(10);
            $browser->loginAs(User::find(1))
                ->visit('/product/' . $product->id)
                ->assertSee('099999999')
                ->assertSee('KHABANH1993@GMAIL.COM')
                ->assertSee('ENGLISH')
                ->click('@english')
                ->assertSee('VIETNAMESE')
                ->assertSee('Bảnh shoe')
                ->assertSee('HOME')
                ->assertSee('PRODUCT')
                ->assertSee('ABOUT')
                ->assertSee('CONTACT')
                ->assertSee('USER')
                ->mouseover('@user-active')
                ->assertSee('Change information')
                ->assertSee('Change password')
                ->assertSee('Order history')
                ->assertSee('Logout')
                ->assertSee($product->name)
                ->assertSee($product->rate)
                ->assertSee(number_format($product->original_price) . " VND")
                ->assertSee(number_format($product->current_price) . " VND")
                ->assertSee(strip_tags($product->description))
                ->assertSee('Quantity');
        });
    }

    public function test_view_product_detail_vietnamese()
    {
        $this->browse(function ($browser) {
            $product = Product::find(10);
            $browser->visit('/product/' . $product->id)
                ->assertSee('099999999')
                ->assertSee('KHABANH1993@GMAIL.COM')
                ->click('@vietnamese')
                ->assertSee('TIẾNG ANH')
                ->assertSee('TIẾNG VIỆT')
                ->assertSee('Bảnh shoe')
                ->assertSee('TRANG CHỦ')
                ->assertSee('SẢN PHẨM')
                ->assertSee('THÔNG TIN VỀ CHÚNG TÔI')
                ->assertSee('LIÊN HỆ')
                ->assertSee('USER')
                ->mouseover('@user-active')
                ->assertSee('Đổi thông tin')
                ->assertSee('Đổi mật khẩu')
                ->assertSee('Lịch sử mua hàng')
                ->assertSee('Đăng xuất')
                ->assertSee($product->name)
                ->assertSee($product->rate)
                ->assertSee(number_format($product->original_price) . " VND")
                ->assertSee(number_format($product->current_price) . " VND")
                ->assertSee(strip_tags($product->description))
                ->assertSee('Số lượng');
        });
    }

    public function test_redirect_to_cart()
    {
        $this->browse(function ($browser) {
            $browser->visit('/product/10')
                ->click('@cart')
                ->assertPathIs('/cart');
        });
    }

    public function test_redirect_to_order_history()
    {
        $this->browse(function ($browser) {
            $browser->visit('/product/10')
                ->waitForText('USER')
                ->mouseover('@user-active')
                ->waitForText('Lịch sử mua hàng')
                ->click('@order-history')
                ->assertPathIs('/order-history');
        });
    }

    public function test_button_add_to_cart()
    {
        $this->browse(function ($browser) {
            $product = Product::find(10);
            $browser->visit('/product/' . $product->id)
                ->waitFor('#add-to-cart')
                ->press($product->productDetails->first()->size)
                ->value('#quantity', 1)
                ->click('@add-to-cart')
                ->assertPathIs('/product/' . $product->id);
        });
    }
}
