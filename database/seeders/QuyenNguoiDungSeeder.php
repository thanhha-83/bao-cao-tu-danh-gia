<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuyenNguoiDungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quyen_nguoi_dungs')->insert([
            ['ten' => 'Viết báo cáo', 'slug' => 'viet-bao-cao'],
            ['ten' => 'Nhận xét báo cáo', 'slug' => 'nhan-xet-bao-cao'],
            ['ten' => 'Phản biện báo cáo', 'slug' => 'phan-bien-bao-cao'],
        ]);
    }
}
