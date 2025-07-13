<?php

namespace App\Action;

use App\Models\User;
use Exception;
use Illuminate\Http\UploadedFile;

class UploadCvFileAction
{

    /**
     * Handles uploading a CV file for the given user.
     *
     * If a file is provided, it will be uploaded and associated with the user under the 'cv_file' media collection.
     *
     * @param User $user  The user who is uploading the CV.
     * @param UploadedFile|null $cvFile  The uploaded CV file, or null if no file is provided.
     *
     * @throws Exception If the uploadMediaFile method throws an exception.
     *
     * @return void
     */
    public function execute(User $user, ?UploadedFile $cvFile): void
    {
        if ($cvFile) {
            $user->uploadMediaFile($cvFile, 'cv_file');
        }
    }
}
