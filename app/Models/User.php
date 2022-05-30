<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use \Datetime;

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
        $vaiTroHTs = auth()->user()->vaiTroHT;
        foreach ($vaiTroHTs as $vaiTroHT) {
            $quyenHTs = $vaiTroHT->quyenHT;
            if ($quyenHTs->contains('slug', $quyenCheck)) {
                return true;
            }
        }
        return false;
    }

    public function checkTime($activity, $baoCao) {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $hoatDongs = $baoCao->nganh->dotDanhGia[0]->hoatDong;
        foreach ($hoatDongs as $hoatDong) {
            $now = new DateTime();
            $startDate = new DateTime($hoatDong->pivot->ngayBD);
            $endDate = new DateTime($hoatDong->pivot->ngayKT);
            if ($hoatDong->slug == $activity && $startDate <= $now && $now <= $endDate) {
                return true;
            }
        }
        return false;
    }
}
