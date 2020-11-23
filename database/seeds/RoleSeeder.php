<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'User',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'name' => 'Admin Product',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'name' => 'Admin Store',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'name' => 'Admin Order',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'name' => 'Admin Supplier',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'name' => 'Management Admin',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
        ]);
    }
}
