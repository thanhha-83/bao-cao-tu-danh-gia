<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuyenHTSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quyen_h_t_s')->insert([
            ['ten' => 'Quản lý tiêu chuẩn', 'slug' => 'quan-ly-tieu-chuan', 'parent_id' => 0],
            ['ten' => 'Xem danh sách tiêu chuẩn', 'slug' => 'xem-danh-sach-tieu-chuan', 'parent_id' => 1],
            ['ten' => 'Xem chi tiết tiêu chuẩn', 'slug' => 'xem-chi-tiet-tieu-chuan', 'parent_id' => 1],
            ['ten' => 'Thêm tiêu chuẩn', 'slug' => 'them-tieu-chuan', 'parent_id' => 1],
            ['ten' => 'Xóa tiêu chuẩn', 'slug' => 'xoa-tieu-chuan', 'parent_id' => 1],
            ['ten' => 'Sửa tiêu chuẩn', 'slug' => 'sua-tieu-chuan', 'parent_id' => 1],
            ['ten' => 'Quản lý tiêu chí', 'slug' => 'quan-ly-tieu-chi', 'parent_id' => 0],
            ['ten' => 'Xem danh sách tiêu chí', 'slug' => 'xem-danh-sach-tieu-chi', 'parent_id' => 7],
            ['ten' => 'Xem chi tiết tiêu chí', 'slug' => 'xem-chi-tiet-tieu-chi', 'parent_id' => 7],
            ['ten' => 'Thêm tiêu chí', 'slug' => 'them-tieu-chi', 'parent_id' => 7],
            ['ten' => 'Xóa tiêu chí', 'slug' => 'xoa-tieu-chi', 'parent_id' => 7],
            ['ten' => 'Sửa tiêu chí', 'slug' => 'sua-tieu-chi', 'parent_id' => 7],
        ]);
    }
}
