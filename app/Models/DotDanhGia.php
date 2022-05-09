<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DotDanhGia extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['ten', 'namHoc'];

    public function nganh()
    {
        return $this
            ->belongsToMany(Nganh::class, 'nganh_dot_danh_gias', 'dotDanhGia_id', 'nganh_id')
            ->withTimestamps();
    }

    public function giaiDoan()
    {
        return $this->hasMany(GiaiDoan::class, 'dotDanhGia_id');
    }
}
