<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MinhChung extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['ten', 'ngayKhaoSat', 'ngayBanHanh', 'noiBanHanh', 'link', 'donVi_id', 'isMCGop'];

    public function donVi()
    {
        return $this->belongsTo(DonVi::class, 'donVi_id');
    }
    public function cTMinhChung() {
        return $this->hasMany(ChiTietMinhChung::class, 'minhChung_id');
    }
}
