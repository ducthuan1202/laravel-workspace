<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'user 01',
            'email' => 'user@website.vn',
            'password' => bcrypt('user@123'),
            'status' => User::STATUS_ACTIVATE,
            'created_at'=> now()
        ]);
    }
}
