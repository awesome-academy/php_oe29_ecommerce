<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Image;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImageTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->image = new Image();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->image);
    }

    public function test_valid_table_properties()
    {
        $this->assertEquals('images', $this->image->getTable());
    }

    public function test_valid_primary_key_properties()
    {
        $this->assertEquals('id', $this->image->getKeyName());
    }

    public function test_valid_fillable_properties()
    {
        $this->assertEquals([
            'image_link',
            'product_id',
        ], $this->image->getFillable());
    }

    public function test_product_function()
    {
        $product = $this->image->product();
        $this->assertInstanceOf(BelongsTo::class, $product);
        $this->assertEquals('product_id', $product->getForeignKeyName());
        $this->assertEquals('id', $product->getOwnerKeyName());
    }
}
