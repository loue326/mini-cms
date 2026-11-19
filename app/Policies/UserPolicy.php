<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can change the target user's role.
     */
    public function changeRole(User $user, User $target): bool
    {
        return $user->id !== $target->id;
    }
}
