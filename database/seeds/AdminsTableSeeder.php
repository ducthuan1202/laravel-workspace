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
                'is_activate' => Admin::BOOLEAN_TRUE,
                'is_super_admin' => Admin::BOOLEAN_TRUE,
                'image'=> '/backend/img/avatars/uifaces2.jpg',
                'password' => bcrypt('admin@123'),
                'created_at' => now()
            ],
            [
                'name' => 'Đức Thuận',
                'email' => 'ducthuan@website.vn',
                'role' => Admin::ROLE_MEMBER,
                'is_activate' => Admin::BOOLEAN_TRUE,
                'is_super_admin' => Admin::BOOLEAN_false,
                'image'=> '/backend/img/avatars/uifaces3.jpg',
                'password' => bcrypt('member@123'),
                'created_at' => now()
            ],
        ]);
    }
}
