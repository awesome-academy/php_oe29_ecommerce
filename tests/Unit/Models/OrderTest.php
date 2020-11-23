<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Order;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class OrderTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->order = new Order();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->order);
    }

    public function test_valid_table_properties()
    {
        $this->assertEquals('orders', $this->order->getTable());
    }

    public function test_valid_primary_key_properties()
    {
        $this->assertEquals('id', $this->order->getKeyName());
    }

    public function test_valid_fillable_properties()
    {
        $this->assertEquals([
            'user_id',
            'address',
            'phone',
            'total_price',
            'note',
            'status',
        ], $this->order->getFillable());
    }

    public function test_user_function()
    {
        $user = $this->order->user();
        $this->assertInstanceOf(BelongsTo::class, $user);
        $this->assertEquals('user_id', $user->getForeignKeyName());
        $this->assertEquals('id', $user->getOwnerKeyName());
    }

    public function test_product_details_function()
    {
        $productDetails = $this->order->productDetails();
        $this->assertInstanceOf(BelongsToMany::class, $productDetails);
        $this->assertEquals('order_id', $productDetails->getForeignPivotKeyName());
        $this->assertEquals('product_detail_id', $productDetails->getRelatedPivotKeyName());
    }
}
