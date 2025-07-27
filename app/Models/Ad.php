<?php

namespace App\Models;

use App\Traits\CompressesMediaCollections;
use App\Traits\HandlesMediaUploads;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Ad extends Model implements HasMedia
{

    use InteractsWithMedia,HandlesMediaUploads;
    use HasFactory;


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('ad')->useDisk('ad')->singleFile(); // تحديد القرص الخاص بهذا الموديل
    }

    public function adViews()
    {
        return $this->hasMany(AdView::class);
    }

    protected $fillable = [
        'title',
        'description',
        'position',
        'is_active',
        'start_at',
        'end_at',
        'clicks',
        'link'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    public function scopeVisible(Builder $query): Builder
    {
        $now = now();

        return $query->where('is_active', true)
            ->where(function ($query) use ($now) {
                $query->whereNull('start_at')->orWhere('start_at', '<=', $now);
            })
            ->where(function ($query) use ($now) {
                $query->whereNull('end_at')->orWhere('end_at', '>=', $now);
            });
    }

}
