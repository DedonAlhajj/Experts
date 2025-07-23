<?php

namespace App\Services;

use App\Action\UploadMediaFileAction;
use App\Exceptions\MediaUploadException;
use App\Models\Ad;
use App\Models\Setting;
use App\Traits\HandlesSettingImages;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

class SettingService
{
    use HandlesSettingImages;

    public function paginate(int $count = 20, ?string $group = null, ?string $key = null): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $query = Setting::query();

        if ($group) {
            $query->where('group', $group);
        }

        if ($key) {
            $query->where('key', 'like', '%' . $key . '%');
        }

        return $query->orderBy('key')->paginate($count);
    }


    public function allCache(): \Illuminate\Support\Collection
    {
        return cache()->remember('settings:all', 3600, fn() =>
        Setting::all()->keyBy('key')
        );
    }

    public function get(string $key, $default = null): mixed
    {
        return cache()->remember("setting:$key", 3600, fn() =>
            Setting::query()->where('key', $key)->value('value') ?? $default
        );
    }


    public function forget(string $key): void
    {
        cache()->forget("setting:$key");
        cache()->forget("settings:all");
    }

    public function findByKey(string $key): Setting
    {
        return Setting::where('key', $key)->firstOrFail();
    }

    public function store(array $data): Setting
    {
        try {
            $value = $data['value'] ?? null;

            if ($data['type'] === 'image' && request()->hasFile('image')) {
                $value = $this->storeSettingImage(request()->file('image')); // ✨ استخدام الـ Trait
            }

            $setting = Setting::create([
                'key'         => $data['key'],
                'value'       => $value,
                'type'        => $data['type'],
                'description' => $data['description'] ?? null,
                'editable'    => true,
            ]);

            $this->forget($data['key']); // بدلاً من Setting::forget(...)

            return $setting;
        } catch (\Throwable $e) {
            Log::error('فشل حفظ الإعداد', [
                'key' => $data['key'] ?? null,
                'error' => $e->getMessage()
            ]);

            throw new \Exception("فشل حفظ الإعداد '{$data['key']}'");
        }
    }

    public function update(string $key, array $data): Setting
    {
        try {
            $setting = Setting::where('key', $key)->firstOrFail();

            $newValue = $this->resolveUpdatedValue($setting, $data);

            $setting->update([
                'value'       => $newValue,
                'description' => $data['description'] ?? $setting->description,
            ]);

            $this->forget($key); // بدلاً من Setting::forget(...)

            return $setting;

        } catch (ModelNotFoundException $e) {
            throw new \Exception("Setting '{$key}' not found");
        } catch (\Throwable $e) {
            Log::error('فشل تعديل الإعداد', [
                'key' => $key,
                'data' => $data,
                'error' => $e->getMessage(),
            ]);

            throw new \Exception("فشل تعديل الإعداد '{$key}'");
        }
    }

    protected function resolveUpdatedValue(Setting $setting, array $data): mixed
    {
        if ($setting->type === 'image') {
            return $this->handleImageUpdate($setting);
        }

        if ($setting->type === 'boolean') {
            return isset($data['value']) && $data['value'] === 'true' ? 'true' : 'false';
        }

        return $data['value'] ?? $setting->value;
    }

    protected function handleImageUpdate(Setting $setting): string
    {
        if (!request()->hasFile('image')) {
            return $setting->value;
        }

        try {
            return $this->replaceSettingImage($setting->value, request()->file('image'));
        } catch (\Throwable $e) {
            Log::error('فشل في تعديل صورة الإعداد', [
                'key' => $setting->key,
                'error' => $e->getMessage(),
            ]);

            throw new \Exception("تعذّر تعديل صورة الإعداد '{$setting->key}'");
        }
    }

    public function delete(string $key): void
    {
        try {
            $setting = Setting::where('key', $key)->firstOrFail();

            if ($setting->type === 'image') {
                $this->deleteSettingImage($setting->value);
            }

            $setting->delete();
            $this->forget($key); // بدلاً من Setting::forget(...)

        } catch (ModelNotFoundException $e) {
            throw new \Exception("الإعداد '{$key}' غير موجود");
        } catch (\Throwable $e) {
            Log::error('فشل حذف الإعداد', [
                'key' => $key,
                'error' => $e->getMessage(),
            ]);

            throw new \Exception("فشل حذف الإعداد '{$key}'");
        }
    }
}
