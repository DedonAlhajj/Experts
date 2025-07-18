<?php

namespace App\Exceptions;

use RuntimeException;

class MediaUploadException extends RuntimeException
{
    protected string $collection;
    protected float $currentSizeKB;
    protected float $maxSizeKB;

    /**
     * MediaUploadException constructor.
     *
     * @param string $collection      اسم المجموعة مثل "profile_image" أو "cv_file"
     * @param float  $currentSizeKB   حجم الملف الحالي بالكيلوبايت
     * @param float  $maxSizeKB       الحد المسموح به بالكيلوبايت
     */
    public function __construct(string $collection, float $currentSizeKB, float $maxSizeKB)
    {
        $this->collection     = $collection;
        $this->currentSizeKB  = $currentSizeKB;
        $this->maxSizeKB      = $maxSizeKB;

        $message = "Upload failed for '{$collection}' collection. File size: " .
            round($currentSizeKB, 1) . "KB exceeds the allowed limit of " .
            round($maxSizeKB, 1) . "KB.";

        parent::__construct($message);
    }

    // ✅ getter methods for more control later
    public function getCollection(): string
    {
        return $this->collection;
    }

    public function getCurrentSizeKB(): float
    {
        return $this->currentSizeKB;
    }

    public function getMaxSizeKB(): float
    {
        return $this->maxSizeKB;
    }
}
