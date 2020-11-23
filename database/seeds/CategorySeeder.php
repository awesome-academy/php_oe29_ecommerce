<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Shoes for Man',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'name' => 'Shoes for Women',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
        ]);
    }
}
