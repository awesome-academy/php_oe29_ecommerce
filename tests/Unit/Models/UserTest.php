<?php

namespace Tests\Unit\Models;

use App\Models\Comment;
use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = new User();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->user);
    }
    
    public function test_valid_cast_properties()
    {
        $this->assertEquals(['id' => 'int', 'email_verified_at' => 'datetime'], $this->user->getCasts());
    }

    public function test_valid_date_properties()
    {
        $this->assertEquals(['deleted_at', 'created_at', 'updated_at'], $this->user->getDates());
    }

    public function test_valid_fillable_properties()
    {
        $this->assertEquals([
            'name',
            'address',
            'phone',
            'email',
            'password',
            'status',
            'role_id',
        ], $this->user->getFillable());
    }

    public function test_name_table()
    {
        $this->assertEquals('users', $this->user->getTable());
    }

    public function test_primary_key_properties()
    {
        $this->assertEquals('id', $this->user->getKeyName());
    }

    public function test_valid_hidden_properties()
    {
        $this->assertEquals(['password', 'remember_token'], $this->user->getHidden());
    }

    public function test_visible_properties()
    {
        $this->assertEquals([], $this->user->getVisible());
    }

    public function test_role_relationship()
    {
        $role =  $this->user->role();
        $this->assertInstanceOf(BelongsTo::class, $role);
        $this->assertEquals('role_id', $role->getForeignKeyName());
        $this->assertEquals('id', $role->getOwnerKeyName());
    }

    public function test_comment_relationships()
    {
        $comments = $this->user->comments();
        $this->assertInstanceOf(HasMany::class, $comments);
        $this->assertEquals('user_id', $comments->getForeignKeyName());
        $this->assertEquals('id', $comments->getLocalKeyName());
    }

    public function test_order_relationships()
    {
        $orders = $this->user->orders();
        $this->assertInstanceOf(HasMany::class, $orders);
        $this->assertEquals('user_id', $orders->getForeignKeyName());
        $this->assertEquals('id', $orders->getLocalKeyName());
    }

}
