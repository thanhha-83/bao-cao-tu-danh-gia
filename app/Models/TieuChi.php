<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TieuChi extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['stt', 'ten', 'tieuChuan_id'];

    public function tieuChuan()
    {
        return $this->belongsTo(TieuChuan::class, 'tieuChuan_id');
    }

    public function yeuCau()
    {
        return $this->hasMany(YeuCau::class, 'tieuChi_id');
    }

    public function mocChuan()
    {
        return $this->hasMany(MocChuan::class, 'tieuChi_id');
    }

    public function tuKhoa()
    {
        return $this
            ->belongsToMany(TuKhoa::class, 'tieu_chi_tu_khoas', 'tieuChi_id', 'tuKhoa_id')
            ->withTimestamps();
    }
}
