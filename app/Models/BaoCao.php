<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaoCao extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['moTa', 'diemManh', 'diemTonTai', 'keHoachHanhDong', 'diemTDG', 'trangThai', 'nganh_id', 'tieuChi_id'];

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
}
