<?php

namespace App\Action;

use App\Models\User;

class UpdateUserInfoAction
{
    /**
     * Updates user information and resets email verification if the email is changed.
     *
     * This method fills the user model with the provided data,
     * checks whether the email has changed, and clears the `email_verified_at` timestamp if needed.
     * Finally, it persists the changes to the database.
     *
     * @param User $user  The user model to update.
     * @param array $data  Associative array containing user attributes to update (e.g. name, email).
     *
     * @return void
     */
    public function execute(User $user, array $data): void
    {
        $user->fill($data);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();
    }
}

