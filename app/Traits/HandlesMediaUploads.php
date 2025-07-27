<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

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
        if (!$file) return;

        if (! $this instanceof HasMedia) {
            throw new \LogicException("Model must implement HasMedia interface.");
        }

        if ($singleFile) {
            $this->clearMediaCollection($collection);
        }

        try {
            $extension = strtolower($file->getClientOriginalExtension());
            $compressedFile = $file;

            // ضغط حسب نوع الملف
            if ($this->isCompressibleImage($extension)) {
                $compressedFile = $this->compressImage($file);
            } elseif ($extension === 'pdf') {
                $compressedFile = $this->compressPdf($file);
            }

            // رفع الملف إلى Media Library
            $this->addMedia($compressedFile)->toMediaCollection($collection);

            // حذف الملف المؤقت بعد الرفع (إن تم الضغط)
            if ($compressedFile !== $file && file_exists($compressedFile->getPathname())) {
                @unlink($compressedFile->getPathname());
            }

        } catch (\Throwable $e) {
            Log::error('File upload failed', [
                'collection' => $collection,
                'model_id' => $this->id ?? null,
                'file_name' => $file->getClientOriginalName(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            throw new \RuntimeException('فشل رفع الملف، يرجى المحاولة لاحقًا.');
        }
    }

    protected function compressPdf(UploadedFile $file): UploadedFile
    {
        $inputPath = $file->getPathname();
        $outputPath = storage_path('app/temp/' . Str::uuid() . '.pdf');

        // تحقق من وجود Ghostscript
        $gsPath = match (PHP_OS_FAMILY) {
            'Windows' => 'C:\\Program Files\\gs\\gs10.05.0\\bin\\gswin64c.exe',
            default => trim(shell_exec('which gs')) ?: '/usr/bin/gs',
        };

        if (!$gsPath || !file_exists($gsPath)) {
            Log::warning('Ghostscript not available, skipping compression', [
                'file_name' => $file->getClientOriginalName(),
                'input_path' => $inputPath,
                'os' => PHP_OS_FAMILY,
                'gsPath' => $gsPath,
            ]);
            return $file; // رفع بدون ضغط
        }


        // بناء أمر الضغط
        $command = "\"{$gsPath}\" -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dPDFSETTINGS=/screen -dNOPAUSE -dQUIET -dBATCH -sOutputFile=\"{$outputPath}\" \"{$inputPath}\"";
        exec($command, $outputLines, $status);

        if ($status !== 0 || !file_exists($outputPath)) {
            Log::error('Ghostscript compression failed', [
                'status' => $status,
                'output' => $outputLines,
                'command' => $command,
                'file_name' => $file->getClientOriginalName(),
            ]);

            // نعيد الملف الأصلي بدون ضغط بدلًا من فشل العملية
            return $file;
        }

        // تسجيل فرق الحجم إذا نجح الضغط
        Log::info('PDF compressed via Ghostscript', [
            'original_size' => filesize($inputPath),
            'compressed_size' => filesize($outputPath),
            'file_name' => $file->getClientOriginalName(),
        ]);

        return new UploadedFile(
            path: $outputPath,
            originalName: $file->getClientOriginalName(),
            mimeType: 'application/pdf',
            error: null,
            test: true
        );
    }

    protected function isCompressibleImage(string $extension): bool
    {
        return in_array($extension, ['jpg', 'jpeg', 'png', 'webp']);
    }

    protected function compressImage(UploadedFile $file): UploadedFile
    {
        $manager = new ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
        $image = $manager->read($file->getPathname());

        // ضغط وتحويل إلى WebP
        $compressed = $image->toWebp(quality: 70);

        $tempPath = storage_path('app/temp/' . Str::uuid() . '.webp');
        $compressed->save($tempPath);

        return new UploadedFile(
            path: $tempPath,
            originalName: pathinfo($tempPath, PATHINFO_BASENAME), // يكون xxx.webp فعليًا
            mimeType: 'image/webp',
            error: null,
            test: true
        );

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



//    public function uploadMediaFile(?UploadedFile $file, string $collection, bool $singleFile = true): void
//    {
//        if (!$file) {
//            return;
//        }
//
//        if (! $this instanceof HasMedia) {
//            throw new \Exception("This model must implement HasMedia interface.");
//        }
//
//        // 🌐 تحقق من الحجم حسب نوع الملف
//        $sizeKB = $file->getSize() / 1024; // الحجم بالكيلوبايت
//
//        $maxSizeKB = match ($collection) {
//            'profile_image' => 1000,        // ⛔ الصور > 300KB مرفوضة
//            'cv_file'       => 1024,       // ⛔ ملفات CV > 1MB مرفوضة
//            default         => 1000,        // حد افتراضي 512KB
//        };
//
//        if ($sizeKB > $maxSizeKB) {
//            throw new MediaUploadException($collection, $sizeKB, $maxSizeKB);
//        }
//
//        try {
//            if ($singleFile) {
//                $this->clearMediaCollection($collection);
//            }
//
//            $this->addMedia($file)->toMediaCollection($collection);
//
//        } catch (\Throwable $e) {
//            Log::error('File upload failed', [
//                'collection' => $collection,
//                'model_id' => $this->id ?? null,
//                'file_name' => $file->getClientOriginalName(),
//                'error' => $e->getMessage(),
//            ]);
//
//            throw new \RuntimeException('فشل رفع الملف، يرجى المحاولة لاحقًا.');
//        }
//    }

//    public function uploadMediaFile(?UploadedFile $file, string $collection, bool $singleFile = true): void
//    {
//        if (!$file) {
//            return;
//        }
//
//        if (! $this instanceof HasMedia) {
//            throw new \Exception("This model must implement HasMedia interface.");
//        }
//
////        $sizeKB = $file->getSize() / 1024;
////
////        $maxSizeKB = match ($collection) {
////            'profile_image' => 1000,
////            'cv_file'       => 1024,
////            default         => 1000,
////        };
////
////        $isCompressible = property_exists($this, 'compressibleMediaCollections') &&
////            in_array($collection, $this->compressibleMediaCollections ?? []);
////
////        if ($sizeKB > $maxSizeKB && !$isCompressible) {
////            throw new MediaUploadException($collection, $sizeKB, $maxSizeKB);
////        }
//
//        try {
//            if ($singleFile) {
//                $this->clearMediaCollection($collection);
//            }
//
//            $this->addMedia($file)->toMediaCollection($collection);
//
//        } catch (\Throwable $e) {
//            Log::error('File upload failed', [
//                'collection' => $collection,
//                'model_id' => $this->id ?? null,
//                'file_name' => $file->getClientOriginalName(),
//                'error' => $e->getMessage(),
//            ]);
//
//            throw new \RuntimeException('فشل رفع الملف، يرجى المحاولة لاحقًا.');
//        }
//    }
}
