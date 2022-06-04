<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaoCao extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['moTa', 'diemManh', 'diemTonTai', 'keHoachHanhDong', 'diemTDG', 'trangThai', 'nganh_id', 'tieuChi_id', 'dotDanhGia_id', 'nguoiDung_id'];
    public $timestamps = true;
    public function tieuChi()
    {
        return $this->belongsTo(TieuChi::class, 'tieuChi_id');
    }

    public function nganh()
    {
        return $this->belongsTo(Nganh::class, 'nganh_id');
    }

    public function binhLuan()
    {
        return $this->hasMany(BinhLuan::class, 'baoCao_id');
    }

    public function baoCaoSL()
    {
        return $this->hasMany(BaoCaoSaoLuu::class, 'baoCao_id');
    }

    public function nhomNguoiDung()
    {
        return $this
            ->belongsToMany(NhomNguoiDung::class, 'nguoi_dung_quyens', 'baoCao_id', 'nhomNguoiDung_id')
            ->withTimestamps();
    }
}
