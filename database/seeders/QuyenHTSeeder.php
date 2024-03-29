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
            ['ten' => 'Quản lý đợt đánh giá', 'slug' => 'quan-ly-dot-danh-gia', 'parent_id' => 0],
            ['ten' => 'Xem danh sách đợt đánh giá', 'slug' => 'xem-danh-sach-dot-danh-gia', 'parent_id' => 1],
            ['ten' => 'Xem chi tiết đợt đánh giá', 'slug' => 'xem-chi-tiet-dot-danh-gia', 'parent_id' => 1],
            ['ten' => 'Thêm đợt đánh giá', 'slug' => 'them-dot-danh-gia', 'parent_id' => 1],
            ['ten' => 'Xóa đợt đánh giá', 'slug' => 'xoa-dot-danh-gia', 'parent_id' => 1],
            ['ten' => 'Sửa đợt đánh giá', 'slug' => 'sua-dot-danh-gia', 'parent_id' => 1],

            ['ten' => 'Quản lý tiêu chuẩn', 'slug' => 'quan-ly-tieu-chuan', 'parent_id' => 0],
            ['ten' => 'Xem danh sách tiêu chuẩn', 'slug' => 'xem-danh-sach-tieu-chuan', 'parent_id' => 7],
            ['ten' => 'Thêm tiêu chuẩn', 'slug' => 'them-tieu-chuan', 'parent_id' => 7],
            ['ten' => 'Xóa tiêu chuẩn', 'slug' => 'xoa-tieu-chuan', 'parent_id' => 7],
            ['ten' => 'Sửa tiêu chuẩn', 'slug' => 'sua-tieu-chuan', 'parent_id' => 7],

            ['ten' => 'Quản lý tiêu chí', 'slug' => 'quan-ly-tieu-chi', 'parent_id' => 0],
            ['ten' => 'Xem danh sách tiêu chí', 'slug' => 'xem-danh-sach-tieu-chi', 'parent_id' => 12],
            ['ten' => 'Xem chi tiết tiêu chí', 'slug' => 'xem-chi-tiet-tieu-chi', 'parent_id' => 12],
            ['ten' => 'Thêm tiêu chí', 'slug' => 'them-tieu-chi', 'parent_id' => 12],
            ['ten' => 'Xóa tiêu chí', 'slug' => 'xoa-tieu-chi', 'parent_id' => 12],
            ['ten' => 'Sửa tiêu chí', 'slug' => 'sua-tieu-chi', 'parent_id' => 12],

            ['ten' => 'Quản lý người dùng', 'slug' => 'quan-ly-nguoi-dung', 'parent_id' => 0],
            ['ten' => 'Xem danh sách người dùng', 'slug' => 'xem-danh-sach-nguoi-dung', 'parent_id' => 18],
            ['ten' => 'Xem chi tiết người dùng', 'slug' => 'xem-chi-tiet-nguoi-dung', 'parent_id' => 18],
            ['ten' => 'Thêm người dùng', 'slug' => 'them-nguoi-dung', 'parent_id' => 18],
            ['ten' => 'Xóa người dùng', 'slug' => 'xoa-nguoi-dung', 'parent_id' => 18],
            ['ten' => 'Sửa người dùng', 'slug' => 'sua-nguoi-dung', 'parent_id' => 18],

            ['ten' => 'Quản lý đơn vị', 'slug' => 'quan-ly-don-vi', 'parent_id' => 0],
            ['ten' => 'Xem danh sách đơn vị', 'slug' => 'xem-danh-sach-don-vi', 'parent_id' => 24],
            ['ten' => 'Thêm đơn vị', 'slug' => 'them-don-vi', 'parent_id' => 24],
            ['ten' => 'Xóa đơn vị', 'slug' => 'xoa-don-vi', 'parent_id' => 24],
            ['ten' => 'Sửa đơn vị', 'slug' => 'sua-don-vi', 'parent_id' => 24],

            ['ten' => 'Quản lý ngành', 'slug' => 'quan-ly-nganh', 'parent_id' => 0],
            ['ten' => 'Xem danh sách ngành', 'slug' => 'xem-danh-sach-nganh', 'parent_id' => 29],
            ['ten' => 'Thêm ngành', 'slug' => 'them-nganh', 'parent_id' => 29],
            ['ten' => 'Xóa ngành', 'slug' => 'xoa-nganh', 'parent_id' => 29],
            ['ten' => 'Sửa ngành', 'slug' => 'sua-nganh', 'parent_id' => 29],

            ['ten' => 'Quản lý nhóm', 'slug' => 'quan-ly-nhom', 'parent_id' => 0],
            ['ten' => 'Xem danh sách nhóm', 'slug' => 'xem-danh-sach-nhom', 'parent_id' => 34],
            ['ten' => 'Xem chi tiết nhóm', 'slug' => 'xem-chi-tiet-nhom', 'parent_id' => 34],
            ['ten' => 'Quản lý thành viên nhóm', 'slug' => 'quan-ly-thanh-vien-nhom', 'parent_id' => 34],
            ['ten' => 'Thêm nhóm', 'slug' => 'them-nhom', 'parent_id' => 34],
            ['ten' => 'Xóa nhóm', 'slug' => 'xoa-nhom', 'parent_id' => 34],
            ['ten' => 'Sửa nhóm', 'slug' => 'sua-nhom', 'parent_id' => 34],

            ['ten' => 'Quản lý minh chứng', 'slug' => 'quan-ly-minh-chung', 'parent_id' => 0],
            ['ten' => 'Xem danh sách minh chứng', 'slug' => 'xem-danh-sach-minh-chung', 'parent_id' => 41],
            ['ten' => 'Xem chi tiết minh chứng', 'slug' => 'xem-chi-tiet-minh-chung', 'parent_id' => 41],
            ['ten' => 'Thêm minh chứng', 'slug' => 'them-minh-chung', 'parent_id' => 41],
            ['ten' => 'Xóa minh chứng', 'slug' => 'xoa-minh-chung', 'parent_id' => 41],
            ['ten' => 'Sửa minh chứng', 'slug' => 'sua-minh-chung', 'parent_id' => 41],

            ['ten' => 'Quản lý vai trò hệ thống', 'slug' => 'quan-ly-vai-tro-he-thong', 'parent_id' => 0],
            ['ten' => 'Xem danh sách vai trò hệ thống', 'slug' => 'xem-danh-sach-vai-tro-he-thong', 'parent_id' => 47],
            ['ten' => 'Thêm vai trò hệ thống', 'slug' => 'them-vai-tro-he-thong', 'parent_id' => 47],
            ['ten' => 'Xóa vai trò hệ thống', 'slug' => 'xoa-vai-tro-he-thong', 'parent_id' => 47],
            ['ten' => 'Sửa vai trò hệ thống', 'slug' => 'sua-vai-tro-he-thong', 'parent_id' => 47],
        ]);
    }
}
