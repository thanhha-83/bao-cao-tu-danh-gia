<?php

namespace App\Services;

use App\Policies\BaoCaoPolicy;
use Illuminate\Support\Facades\Gate;
use App\Policies\DotDanhGiaPolicy;
use App\Policies\VaiTroHeThongPolicy;
use App\Policies\TieuChuanPolicy;
use App\Policies\TieuChiPolicy;
use App\Policies\DonViPolicy;
use App\Policies\NganhPolicy;
use App\Policies\NhomPolicy;
use App\Policies\NguoiDungPolicy;
use App\Policies\MinhChungPolicy;
use App\Policies\GiaiDoanPolicy;
use App\Policies\QuanLyNhomPolicy;

class PermissionGateAndPolicyAccess {

    public function setGateAndPolicyAccess()
    {
        $this->defineGateCategory();
    }

    public function defineGateCategory()
    {
        Gate::define('dotdanhgia-danhsach', [DotDanhGiaPolicy::class, 'viewAny']);
        Gate::define('dotdanhgia-chitiet', [DotDanhGiaPolicy::class, 'view']);
        Gate::define('dotdanhgia-them', [DotDanhGiaPolicy::class, 'create']);
        Gate::define('dotdanhgia-sua', [DotDanhGiaPolicy::class, 'update']);
        Gate::define('dotdanhgia-xoa', [DotDanhGiaPolicy::class, 'delete']);
        Gate::define('dotdanhgia-dieukhien', [DotDanhGiaPolicy::class, 'control']);

        Gate::define('vaitrohethong-danhsach', [VaiTroHeThongPolicy::class, 'viewAny']);
        Gate::define('vaitrohethong-them', [VaiTroHeThongPolicy::class, 'create']);
        Gate::define('vaitrohethong-sua', [VaiTroHeThongPolicy::class, 'update']);
        Gate::define('vaitrohethong-xoa', [VaiTroHeThongPolicy::class, 'delete']);

        Gate::define('tieuchuan-danhsach', [TieuChuanPolicy::class, 'viewAny']);
        Gate::define('tieuchuan-them', [TieuChuanPolicy::class, 'create']);
        Gate::define('tieuchuan-sua', [TieuChuanPolicy::class, 'update']);
        Gate::define('tieuchuan-xoa', [TieuChuanPolicy::class, 'delete']);

        Gate::define('tieuchi-danhsach', [TieuChiPolicy::class, 'viewAny']);
        Gate::define('tieuchi-chitiet', [TieuChiPolicy::class, 'view']);
        Gate::define('tieuchi-them', [TieuChiPolicy::class, 'create']);
        Gate::define('tieuchi-sua', [TieuChiPolicy::class, 'update']);
        Gate::define('tieuchi-xoa', [TieuChiPolicy::class, 'delete']);

        Gate::define('donvi-danhsach', [DonViPolicy::class, 'viewAny']);
        Gate::define('donvi-them', [DonViPolicy::class, 'create']);
        Gate::define('donvi-sua', [DonViPolicy::class, 'update']);
        Gate::define('donvi-xoa', [DonViPolicy::class, 'delete']);

        Gate::define('nganh-danhsach', [NganhPolicy::class, 'viewAny']);
        Gate::define('nganh-them', [NganhPolicy::class, 'create']);
        Gate::define('nganh-sua', [NganhPolicy::class, 'update']);
        Gate::define('nganh-xoa', [NganhPolicy::class, 'delete']);

        Gate::define('nhom-danhsach', [NhomPolicy::class, 'viewAny']);
        Gate::define('nhom-chitiet', [NhomPolicy::class, 'view']);
        Gate::define('nhom-them', [NhomPolicy::class, 'create']);
        Gate::define('nhom-sua', [NhomPolicy::class, 'update']);
        Gate::define('nhom-xoa', [NhomPolicy::class, 'delete']);
        Gate::define('nhom-thanhvien', [NhomPolicy::class, 'detail']);

        Gate::define('nguoidung-danhsach', [NguoiDungPolicy::class, 'viewAny']);
        Gate::define('nguoidung-chitiet', [NguoiDungPolicy::class, 'view']);
        Gate::define('nguoidung-them', [NguoiDungPolicy::class, 'create']);
        Gate::define('nguoidung-sua', [NguoiDungPolicy::class, 'update']);
        Gate::define('nguoidung-xoa', [NguoiDungPolicy::class, 'delete']);

        Gate::define('minhchung-danhsach', [MinhChungPolicy::class, 'viewAny']);
        Gate::define('minhchung-chitiet', [MinhChungPolicy::class, 'view']);
        Gate::define('minhchung-them', [MinhChungPolicy::class, 'create']);
        Gate::define('minhchung-sua', [MinhChungPolicy::class, 'update']);
        Gate::define('minhchung-xoa', [MinhChungPolicy::class, 'delete']);

        Gate::define('time-viet-bao-cao', [GiaiDoanPolicy::class, 'update']);
        Gate::define('time-nhan-xet-bao-cao', [GiaiDoanPolicy::class, 'comment']);
        Gate::define('time-phan-bien-bao-cao', [GiaiDoanPolicy::class, 'counterArg']);

        // Gate::define('minhchung-danhsach', [MinhChungPolicy::class, 'viewAny']);
        // Gate::define('minhchung-chitiet', [MinhChungPolicy::class, 'view']);
        Gate::define('baocao-them', [BaoCaoPolicy::class, 'create']);
        Gate::define('baocao-sua', [BaoCaoPolicy::class, 'editAny']);
        // Gate::define('minhchung-sua', [MinhChungPolicy::class, 'update']);
        // Gate::define('minhchung-xoa', [MinhChungPolicy::class, 'delete']);

        Gate::define('quanlynhom', [QuanLyNhomPolicy::class, 'control']);
    }
}
