<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MinhChungPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.minhchung-danhsach'));
    }

    public function view(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.minhchung-chitiet'));
    }

    public function create(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.minhchung-them'));
    }

    public function update(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.minhchung-sua'));
    }

    public function delete(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.minhchung-xoa'));
    }
}
