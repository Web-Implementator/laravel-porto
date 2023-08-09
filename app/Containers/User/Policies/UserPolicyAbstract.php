<?php

declare(strict_types=1);

namespace App\Containers\User\Policies;

use App\Containers\User\Models\UserModel;
use App\Ship\Abstracts\Policies\PolicyAbstract;
use Illuminate\Auth\Access\HandlesAuthorization;

final class UserPolicyAbstract extends PolicyAbstract
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserModel $userModel): bool
    {
        return $userModel->id === 1;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function requestApi(UserModel $userModel): bool
    {
        return $userModel->id === 1;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(UserModel $userModel, UserModel $model): bool
    {
        return $userModel->id === 1;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserModel $userModel): bool
    {
        return $userModel->id === 1;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(UserModel $userModel, UserModel $model): bool
    {
        return $userModel->id === 1;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(UserModel $userModel, UserModel $model): bool
    {
        return $userModel->id === 1;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(UserModel $userModel, UserModel $model): bool
    {
        return $userModel->id === 1;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserModel $userModel, UserModel $model): bool
    {
        return $userModel->id === 1;
    }
}
