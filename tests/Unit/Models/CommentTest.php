<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommentTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->comment = new Comment();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->comment);
    }

    public function test_valid_table_properties()
    {
        $this->assertEquals('comments', $this->comment->getTable());
    }

    public function test_valid_primary_key_properties()
    {
        $this->assertEquals('id', $this->comment->getKeyName());
    }

    public function test_valid_fillable_properties()
    {
        $this->assertEquals([
            'message',
            'status',
            'rate',
            'product_id',
            'user_id',
            'parent_id',
        ], $this->comment->getFillable());
    }

    public function test_replies_function()
    {
        $replies = $this->comment->replies();
        $this->assertInstanceOf(HasMany::class, $replies);
        $this->assertEquals('parent_id', $replies->getForeignKeyName());
        $this->assertEquals('id', $replies->getLocalKeyName());
    }

    public function test_user_function()
    {
        $user = $this->comment->user();
        $this->assertInstanceOf(BelongsTo::class, $user);
        $this->assertEquals('user_id', $user->getForeignKeyName());
        $this->assertEquals('id', $user->getOwnerKeyName());
    }

    public function test_product_function()
    {
        $product = $this->comment->product();
        $this->assertInstanceOf(BelongsTo::class, $product);
        $this->assertEquals('product_id', $product->getForeignKeyName());
        $this->assertEquals('id', $product->getOwnerKeyName());
    }
}
