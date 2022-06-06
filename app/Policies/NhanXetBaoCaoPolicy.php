<?php

namespace App\Policies;

use App\Models\User;
use App\Models\BaoCao;
use App\Models\NhomNguoiDung;
use App\Services\NhanXetBaoCaoPermission;
use Illuminate\Auth\Access\HandlesAuthorization;

class NhanXetBaoCaoPolicy
{
    use HandlesAuthorization;

    public function view()
    {
        $baoCaoPer = new NhanXetBaoCaoPermission();
        return $baoCaoPer->view();
    }

    public function comment(User $user, $id)
    {
        $baoCao = BaoCao::find($id);
        $nhomNguoiDungs = NhomNguoiDung::where('nguoiDung_id', $user->id)->get();
        $baoCaoPer = new NhanXetBaoCaoPermission();
        return $baoCaoPer->comment($nhomNguoiDungs, $baoCao);
    }
}
