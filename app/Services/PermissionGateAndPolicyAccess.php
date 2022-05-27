<?php

namespace App\Services;

use Illuminate\Support\Facades\Gate;
use App\Policies\TieuChuanPolicy;
use App\Policies\TieuChiPolicy;

class PermissionGateAndPolicyAccess {

    public function setGateAndPolicyAccess()
    {
        $this->defineGateCategory();
    }

    public function defineGateCategory()
    {
        Gate::define('tieuchuan-danhsach', [TieuChuanPolicy::class, 'viewAny']);
        Gate::define('tieuchuan-them', [TieuChuanPolicy::class, 'create']);
        Gate::define('tieuchuan-sua', [TieuChuanPolicy::class, 'update']);
        Gate::define('tieuchuan-xoa', [TieuChuanPolicy::class, 'delete']);

        Gate::define('tieuchi-danhsach', [TieuChiPolicy::class, 'viewAny']);
        Gate::define('tieuchi-chitiet', [TieuChiPolicy::class, 'view']);
        Gate::define('tieuchi-them', [TieuChiPolicy::class, 'create']);
        Gate::define('tieuchi-sua', [TieuChiPolicy::class, 'update']);
        Gate::define('tieuchi-xoa', [TieuChiPolicy::class, 'delete']);
    }
}
