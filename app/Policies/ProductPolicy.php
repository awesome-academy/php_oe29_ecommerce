<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
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
        return $user->role_id == config('role.admin.product') || $user->role_id == config('role.admin.management');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Product  $product
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->role_id == config('role.admin.product') || $user->role_id == config('role.admin.management');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role_id == config('role.admin.product') || $user->role_id == config('role.admin.management');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Product  $product
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->role_id == config('role.admin.product') || $user->role_id == config('role.admin.management');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Product  $product
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->role_id == config('role.admin.product') || $user->role_id == config('role.admin.management');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Product  $product
     * @return mixed
     */
    public function restore(User $user)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Product  $product
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        //
    }

    public function deleteImage(User $user)
    {
        return $user->role_id == config('role.admin.product') || $user->role_id == config('role.admin.management');
    }

    public function deleteProductDetail(User $user)
    {
        return $user->role_id == config('role.admin.product') || $user->role_id == config('role.admin.management');
    }
}
