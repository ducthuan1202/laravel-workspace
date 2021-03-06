<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $data = [];

        for ($i = 0; $i < 100; $i++):
            $name = $faker->company;
            $data[] = [
                'created_by' => rand(1,2),
                'name' => $name,
                'slug' => Str::slug($name),
                'is_activate' => rand(0,1),
                'created_at' => now()
            ];
        endfor;

        DB::table('categories')->insert($data);
    }
}
