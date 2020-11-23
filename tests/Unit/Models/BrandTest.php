<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BrandTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->brand = new Brand();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->brand);
    }

    public function test_valid_table_properties()
    {
        $this->assertEquals('brands', $this->brand->getTable());
    }

    public function test_valid_primary_key_properties()
    {
        $this->assertEquals('id', $this->brand->getKeyName());
    }

    public function test_valid_fillable_properties()
    {
        $this->assertEquals([
            'name'
        ], $this->brand->getFillable());
    }

    public function test_products_relation()
    {
        $products = $this->brand->products();
        $this->assertInstanceOf(HasMany::class, $products);
        $this->assertEquals('brand_id', $products->getForeignKeyName());
        $this->assertEquals('id', $products->getLocalKeyName());
    }
}
