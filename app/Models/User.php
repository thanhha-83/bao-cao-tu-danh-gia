<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'hoTen',
        'gioiTinh',
        'ngaySinh',
        'sdt',
        'chucVu',
        'email',
        'password',
        'donVi_id',
        'hinhAnh'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function donVi()
    {
        return $this->belongsTo(DonVi::class, 'donVi_id');
    }

    public function vaiTroHT()
    {
        return $this
            ->belongsToMany(VaiTroHT::class, 'nguoi_dung_vai_tro_h_t_s', 'nguoiDung_id', 'vaiTroHT_id')
            ->withTimestamps();
    }

    public function checkPermissionAccess($quyenCheck)
    {
        // use login co quyen add, sua danh muc va xem menu
        // B1 lay duoc tat ca cac quyen cua user dang login he thong
        // B2 So sanh gia tri dua vao cua router hien tai xem co ton tai trong cac quyen ma minh lay dc hay khong
        $vaiTroHTs = auth()->user()->vaiTroHT;
        foreach ($vaiTroHTs as $vaiTroHT) {
            $quyenHTs = $vaiTroHT->quyenHT;
            if ($quyenHTs->contains('slug', $quyenCheck)) {
                return true;
            }
        }
        return false;
    }
}
