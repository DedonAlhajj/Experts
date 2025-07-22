<?php

namespace App\Action;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class UploadMediaFileAction
{

    /**
     * رفع ملف إلى مجموعة ميديا داخل موديل يدعم الرفع
     *
     * @param Model $model
     * @param UploadedFile|null $file
     * @param string $collection
     * @param bool $singleFile
     */
    public function execute(Model $model, ?UploadedFile $file, string $collection, bool $singleFile = true): void
    {
        if (! $file) {
            return; // لا داعي لتنفيذ شيء إذا لم يوجد ملف
        }

        if (! method_exists($model, 'uploadMediaFile')) {
            throw new \RuntimeException("Model " . get_class($model) . " doesn't use HandlesMediaUploads.");
        }

        $model->uploadMediaFile($file, $collection, $singleFile);
    }

}
