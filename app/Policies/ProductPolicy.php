<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
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
        return $user->role_id == config('role.admin.management') || $user->role_id == config('role.admin.product');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Model\Product  $product
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->role_id == config('role.admin.management') || $user->role_id == config('role.admin.product');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role_id == config('role.admin.management') || $user->role_id == config('role.admin.product');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Model\Product  $product
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->role_id == config('role.admin.management') || $user->role_id == config('role.admin.product');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Model\Product  $product
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->role_id == config('role.admin.management') || $user->role_id == config('role.admin.product');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Model\Product  $product
     * @return mixed
     */
    public function restore(User $user, Product $product)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Model\Product  $product
     * @return mixed
     */
    public function forceDelete(User $user, Product $product)
    {
        //
    }

    public function deleteImage(User $user)
    {
        return $user->role_id == config('role.admin.management') || $user->role_id == config('role.admin.product');
    }

    public function deleteProductDetail(User $user)
    {
        return $user->role_id == config('role.admin.management') || $user->role_id == config('role.admin.product');
    }
}
