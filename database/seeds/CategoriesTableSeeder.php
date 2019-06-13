<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
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
                'created_by' => 1,
                'name' => 'Laravel',
                'slug' => 'laravel',
                'image' => null,
                'created_at' => now()
            ],
            [
                'created_by' => 1,
                'name' => 'Node JS',
                'slug' => 'node-js',
                'image' => null,
                'created_at' => now()
            ],
        ]);
    }
}
