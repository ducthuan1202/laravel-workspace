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
        for ($i = 0; $i < 1000; $i++):
            $name = $faker->sentence();
            $data[] = [
                'created_by' => 1,
                'name' => $name,
                'slug' => Str::slug($name),
                'image' => $faker->imageUrl(),
                'created_at' => now()
            ];
        endfor;
        DB::table('categories')->insert($data);
    }
}
