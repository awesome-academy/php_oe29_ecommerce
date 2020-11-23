<?php

namespace Tests\Unit\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class RoleTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    protected $role;

    public function setUp(): void
    {
        parent::setUp();
        $this->role = new Role();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->role);
    }

    public function test_valid_date_properties()
    {
        $this->assertEquals(['deleted_at', 'created_at', 'updated_at'], $this->role->getDates());
    }

    public function test_valid_fillable_properties()
    {
        $this->assertEquals(['name'], $this->role->getFillable());
    }

    public function test_valid_hidden_properties()
    {
        $this->assertEquals([], $this->role->getHidden());
    }

    public function test_valid_primary_key_properties()
    {
        $this->assertEquals('id', $this->role->getKeyName());
    }

    public function test_valid_visible_properties()
    {
        $this->assertEquals([], $this->role->getVisible());
    }

    public function test_table_name()
    {
        $this->assertEquals('roles', $this->role->getTable());
    }

    public function test_user_relationships()
    {
        $users = $this->role->users();
        $this->assertInstanceOf(HasMany::class, $users);
        $this->assertEquals('role_id', $users->getForeignKeyName());
        $this->assertEquals('id', $users->getLocalKeyName());
    }
}
