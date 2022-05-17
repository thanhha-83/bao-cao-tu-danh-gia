<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TieuChuan extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['stt', 'ten', 'noiDung'];

    public function tieuChi()
    {
        return $this->hasMany(TieuChi::class, 'tieuChuan_id');
    }
}
