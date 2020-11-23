<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'role_id' => 1,
                'name' => 'User',
                'email' => 'user@gmail.com',
                'status' => 1,
                'password' => '$2y$10$0fCySFAnObCKLxDY7Dru0uG5.pJwISjBarh/7MwubrNSqfChZC1a.',
                'remember_token' => Str::random(10),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'role_id' => 2,
                'name' => 'Admin',
                'email' => 'admin.product@gmail.com',
                'status' => 1,
                'password' => '$2y$10$0fCySFAnObCKLxDY7Dru0uG5.pJwISjBarh/7MwubrNSqfChZC1a.',
                'remember_token' => Str::random(10),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'role_id' => 3,
                'name' => 'Admin',
                'email' => 'admin.store@gmail.com',
                'status' => 1,
                'password' => '$2y$10$0fCySFAnObCKLxDY7Dru0uG5.pJwISjBarh/7MwubrNSqfChZC1a.',
                'remember_token' => Str::random(10),

                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'role_id' => 4,
                'name' => 'Admin',
                'email' => 'admin.order@gmail.com',
                'status' => 1,
                'password' => '$2y$10$0fCySFAnObCKLxDY7Dru0uG5.pJwISjBarh/7MwubrNSqfChZC1a.',
                'remember_token' => Str::random(10),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'role_id' => 5,
                'name' => 'Admin',
                'email' => 'admin.supplier@gmail.com',
                'status' => 1,
                'password' => '$2y$10$0fCySFAnObCKLxDY7Dru0uG5.pJwISjBarh/7MwubrNSqfChZC1a.',
                'remember_token' => Str::random(10),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'role_id' => 6,
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'status' => 1,
                'password' => '$2y$10$0fCySFAnObCKLxDY7Dru0uG5.pJwISjBarh/7MwubrNSqfChZC1a.',
                'remember_token' => Str::random(10),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
        ]);
    }
}
