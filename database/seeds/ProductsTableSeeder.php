<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
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
            $name = $faker->jobTitle;
            $data[] = [
                'category_id' => rand(1,100),
                'created_by' => rand(1,2),
                'name' => $name,
                'slug' => Str::slug($name),
                'price' => $faker->numberBetween(300, 1000),
                'views' => $faker->numberBetween(0, 500),
                'status' => rand(0,1),
                'is_feature' => rand(0,1),
                'created_at' => now()
            ];
        endfor;

        DB::table('products')->insert($data);
    }
}
