<?php

namespace App\Action;

use App\Models\User;
use Illuminate\Http\UploadedFile;

class UploadProfileImageAction
{
    public function execute(User $user, ?UploadedFile $image): void
    {
        if ($image) {
            $user->uploadMediaFile($image, 'profile_image');
        }
    }
}

