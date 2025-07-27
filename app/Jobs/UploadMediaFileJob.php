<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UploadMediaFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        protected Model $model,
        protected string $filePath,
        protected string $collection,
        protected bool $singleFile = true
    ) {}


    public function handle(): void
    {
        if (!method_exists($this->model, 'uploadMediaFile')) {
            Log::warning('Model missing uploadMediaFile');
            return;
        }

        $fullPath = storage_path('app/' . $this->filePath);

        if (!file_exists($fullPath)) {
            Log::error("File path not found: " . $fullPath);
            return;
        }

        $file = new \Illuminate\Http\UploadedFile(
            path: $fullPath,
            originalName: basename($fullPath),
            mimeType: mime_content_type($fullPath),
            error: null,
            test: true
        );

        $this->model->uploadMediaFile($file, $this->collection, $this->singleFile);

        // حذف الملف المؤقت بعد المعالجة
        @unlink($fullPath);
    }

}

