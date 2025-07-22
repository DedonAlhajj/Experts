<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HandlesSettingImages
{
    protected function storeSettingImage(UploadedFile $image): string
    {
        return $image->store('settings/images', 'public');
    }

    protected function deleteSettingImage(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    protected function replaceSettingImage(?string $oldPath, UploadedFile $newImage): string
    {
        $this->deleteSettingImage($oldPath);
        return $this->storeSettingImage($newImage);
    }
}

