<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YeuCau extends Model
{
    use HasFactory;
    protected $fillable = ['noiDung', 'tieuChi_id'];
}
