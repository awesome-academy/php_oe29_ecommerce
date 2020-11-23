<?php

namespace Tests\Unit\Models;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tests\TestCase;

class SupplierTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    protected $supplier;

    public function setUp(): void
    {
        parent::setUp();
        $this->supplier = new Supplier();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->supplier);
    }

    public function test_valid_date_properties()
    {
        $this->assertEquals(['deleted_at', 'created_at', 'updated_at'], $this->supplier->getDates());
    }

    public function test_valid_fillable_properties()
    {
        $this->assertEquals(['name', 'address', 'phone', 'description'], $this->supplier->getFillable());
    }

    public function test_valid_hidden_properties()
    {
        $this->assertEquals([], $this->supplier->getHidden());
    }

    public function test_valid_primary_key_properties()
    {
        $this->assertEquals('id', $this->supplier->getKeyName());
    }

    public function test_valid_visible_properties()
    {
        $this->assertEquals([], $this->supplier->getVisible());
    }

    public function test_table_name()
    {
        $this->assertEquals('suppliers', $this->supplier->getTable());
    }

    public function test_product_relationships()
    {
        $products = $this->supplier->products();
        $this->assertInstanceOf(BelongsToMany::class, $products);
        $this->assertEquals('supplier_id', $products->getForeignPivotKeyName());
        $this->assertEquals('product_id', $products->getRelatedPivotKeyName());
    }
}
