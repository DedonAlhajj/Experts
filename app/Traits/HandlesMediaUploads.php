<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\HasMedia;

trait HandlesMediaUploads
{
    /**
     * رفع ملف واحد إلى مجموعة ميديا محددة
     *
     * @param UploadedFile|null $file
     * @param string $collection
     * @param bool $singleFile هل يتم استبدال الملف السابق تلقائيًا؟
     * @return void
     */
    public function uploadMediaFile(?UploadedFile $file, string $collection, bool $singleFile = true): void
    {
        if (!$file) {
            return;
        }

        if (! $this instanceof HasMedia) {
            throw new \Exception("This model must implement HasMedia interface.");
        }

        try {
            // استبدال الملف القديم إن كان single
            if ($singleFile) {
                $this->clearMediaCollection($collection);
            }

            $this->addMedia($file)->toMediaCollection($collection);

        } catch (\Throwable $e) {
            Log::error('File upload failed', [
                'collection' => $collection,
                'model_id' => $this->id ?? null,
                'file_name' => $file->getClientOriginalName(),
                'error' => $e->getMessage(),
            ]);

            throw new \RuntimeException('فشل رفع الملف، يرجى المحاولة لاحقًا.');
        }
    }

    /**
     * رفع عدة ملفات إلى مجموعة ميديا واحدة
     *
     * @param array $files
     * @param string $collection
     * @return void
     */
    public function uploadMultipleMediaFiles(array $files, string $collection): void
    {
        if (empty($files)) {
            return;
        }

        if (! $this instanceof HasMedia) {
            throw new \Exception("This model must implement HasMedia interface.");
        }

        foreach ($files as $file) {
            if ($file instanceof UploadedFile) {
                $this->uploadMediaFile($file, $collection, false);
            }
        }
    }
}
