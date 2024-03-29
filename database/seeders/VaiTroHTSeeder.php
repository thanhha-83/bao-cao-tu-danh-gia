<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VaiTroHTSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vai_tro_h_t_s')->insert([
            ['ten' => 'Quản trị hệ thống', 'slug' => 'quan-tri-he-thong'],
            ['ten' => 'Chủ tịch', 'slug' => 'chu-tich'],
            ['ten' => 'Phó chủ tịch', 'slug' => 'pho-chu-tich'],
            ['ten' => 'Thư ký', 'slug' => 'thu-ky'],
            ['ten' => 'Thành viên', 'slug' => 'thanh-vien'],
        ]);
    }
}
