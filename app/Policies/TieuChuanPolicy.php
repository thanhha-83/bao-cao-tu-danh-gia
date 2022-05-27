<?php

namespace App\Policies;

use App\Models\TieuChuan;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TieuChuanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.tieuchuan-danhsach'));
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TieuChuan  $tieuChuan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, TieuChuan $tieuChuan)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.tieuchuan-them'));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TieuChuan  $tieuChuan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.tieuchuan-sua'));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TieuChuan  $tieuChuan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.tieuchuan-xoa'));
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TieuChuan  $tieuChuan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, TieuChuan $tieuChuan)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TieuChuan  $tieuChuan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, TieuChuan $tieuChuan)
    {
        //
    }
}
