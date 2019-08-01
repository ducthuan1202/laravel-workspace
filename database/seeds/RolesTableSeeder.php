<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
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
                'name' => 'Admin',
                'description' => 'Toàn quyền trên hệ thống',
                'created_at' => now()
            ], [
                'name' => 'Sale',
                'description' => 'Nhân viên kinh doanh',
                'created_at' => now()
            ], [
                'name' => 'Marketing',
                'description' => 'Nhân viên Marketing',
                'created_at' => now()
            ], [
                'name' => 'Viewer',
                'description' => 'Sử dụng để đăng nhập trên màn hình báo cáo',
                'created_at' => now()
            ]
        ]);
    }
}
