<?php

namespace Tests\Unit\Models;

use App\Models\ProductDetail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tests\TestCase;

class ProductDetailTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    protected $productDetail;

    public function setUp(): void
    {
        parent::setUp();
        $this->productDetail = new ProductDetail();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->productDetail);
    }

    public function test_valid_date_properties()
    {
        $this->assertEquals(['deleted_at', 'created_at', 'updated_at'], $this->productDetail->getDates());
    }

    public function test_valid_fillable_properties()
    {
        $this->assertEquals(['size', 'quantity', 'product_id'], $this->productDetail->getFillable());
    }

    public function test_valid_hidden_properties()
    {
        $this->assertEquals([], $this->productDetail->getHidden());
    }

    public function test_valid_primary_properties()
    {
        $this->assertEquals('id', $this->productDetail->getKeyName());
    }

    public function test_valid_visible_properties()
    {
        $this->assertEquals([], $this->productDetail->getVisible());
    }

    public function test_valid_table_name()
    {
        $this->assertEquals('product_details', $this->productDetail->getTable());
    }

    public function test_product_relationship()
    {
        $product = $this->productDetail->product();
        $this->assertInstanceOf(BelongsTo::class, $product);
        $this->assertEquals('product_id', $product->getForeignKeyName());
        $this->assertEquals('id', $product->getOwnerKeyName());
    }

    public function test_order_relationships()
    {
        $orders = $this->productDetail->orders();
        $this->assertInstanceOf(BelongsToMany::class, $orders);
        $this->assertEquals('product_detail_id', $orders->getForeignPivotKeyName());
        $this->assertEquals('order_id', $orders->getRelatedPivotKeyName());
    }
}
