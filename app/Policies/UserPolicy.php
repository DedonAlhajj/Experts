<?php

namespace App\Policies;

use App\Models\ExpertInfo;
use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {

    }

    public function modifyOwnProfile(User $authUser, User $profileOwner): bool
    {
        return $authUser->id === $profileOwner->id;
    }

    public function modifyOwn(User $user, ExpertInfo $expertInfo): bool
    {
        return $user->id === $expertInfo->user_id;
    }

}
