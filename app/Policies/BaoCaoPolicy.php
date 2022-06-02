<?php

namespace App\Policies;

use App\Models\User;
use App\Services\BaoCaoPermission;
use Illuminate\Auth\Access\HandlesAuthorization;

class BaoCaoPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function create()
    {
        $baoCaoPer = new BaoCaoPermission();
        return $baoCaoPer->create();
    }

    public function update(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.donvi-sua'));
    }

    public function delete(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.donvi-xoa'));
    }
}
