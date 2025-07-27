<?php

namespace App\Traits;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait CompressesMediaCollections
{
    public function registerMediaConversions(Media $media = null): void
    {
        // تحقق من وجود اسم المجموعة ضمن المجموعات القابلة للضغط
        if (
            isset($media) &&
            property_exists($this, 'compressibleMediaCollections') &&
            in_array($media->collection_name, $this->compressibleMediaCollections)
        ) {
            $this->addMediaConversion('compressed')
                ->format('webp')
                ->quality(70)
                ->width(800)
                ->nonQueued();
        }
    }
}
