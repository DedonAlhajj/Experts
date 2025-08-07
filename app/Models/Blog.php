<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\HandlesMediaUploads;

class Blog extends Model implements HasMedia
{
    use InteractsWithMedia,HandlesMediaUploads;
    use HasFactory;



    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('blog_image')->useDisk('blog_image')->singleFile(); // تحديد القرص الخاص بهذا الموديل
    }
    protected $fillable = [
        'user_id',
        'title',
        'summary',
        'content',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

