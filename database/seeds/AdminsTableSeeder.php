<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'name' => 'Administrator',
                'email' => 'admin@website.vn',
                'role' => Admin::ROLE_ADMIN,
                'status' => Admin::STATUS_ACTIVATE,
                'password' => bcrypt('admin@123'),
                'created_at' => now()
            ],
            [
                'name' => 'Đức Thuận',
                'email' => 'ducthuan@website.vn',
                'role' => Admin::ROLE_MEMBER,
                'status' => Admin::STATUS_ACTIVATE,
                'password' => bcrypt('member@123'),
                'created_at' => now()
            ],
        ]);
    }
}
