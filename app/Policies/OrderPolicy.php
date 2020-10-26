<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Order;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return  $user->role_id == config('role.admin.order') || $user->role_id == config('role.admin.management');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Order  $order
     * @return mixed
     */
    public function view(User $user)
    {
        return  $user->role_id == config('role.admin.order') || $user->role_id == config('role.admin.management');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return  $user->role_id == config('role.admin.order') || $user->role_id == config('role.admin.management');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Order  $order
     * @return mixed
     */
    public function update(User $user)
    {
        return  $user->role_id == config('role.admin.order') || $user->role_id == config('role.admin.management');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Order  $order
     * @return mixed
     */
    public function delete(User $user)
    {
        return  $user->role_id == config('role.admin.order') || $user->role_id == config('role.admin.management');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Order  $order
     * @return mixed
     */
    public function restore(User $user)
    {
        return  $user->role_id == config('role.admin.order') || $user->role_id == config('role.admin.management');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Order  $order
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return  $user->role_id == config('role.admin.order') || $user->role_id == config('role.admin.management');
    }

    public function approvedOrder(User $user)
    {
        return  $user->role_id == config('role.admin.order') || $user->role_id == config('role.admin.management');
    }

    public function rejectedOrder(User $user)
    {
        return  $user->role_id == config('role.admin.order') || $user->role_id == config('role.admin.management');
    }
}
