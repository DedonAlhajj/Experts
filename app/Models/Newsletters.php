<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;

class Newsletters extends Model implements HasMedia
{

    use \Spatie\MediaLibrary\InteractsWithMedia, \App\Traits\HandlesMediaUploads;
    use HasFactory;


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('newsletters')->useDisk('newsletters')->singleFile(); // تحديد القرص الخاص بهذا الموديل
    }


    protected $fillable = [
        'title',
        'body',
        'cta_label',
        'cta_url',
        'is_sent',
        'send_at',
        'repeat_type',
        'repeat_interval',
        'next_send_at',
    ];


    // نوع الحقول
    protected $casts = [
        'is_sent' => 'boolean',
        'send_at' => 'datetime',
        'next_send_at' => 'datetime',
    ];



    public function calculateNextSendAt(): ?Carbon
    {
        if (!$this->send_at || !$this->repeat_type || !$this->repeat_interval) {
            return null; // لا يمكن الحساب بدون المعطيات الثلاثة
        }

        $sendAt = Carbon::parse($this->send_at);

        return match ($this->repeat_type) {
            'daily'   => $sendAt->copy()->addDays($this->repeat_interval),
            'weekly'  => $sendAt->copy()->addWeeks($this->repeat_interval),
            'monthly' => $sendAt->copy()->addMonths($this->repeat_interval),
            default   => null,
        };
    }
    public function calculateNextSendAtFrom(Carbon|string $from): ?Carbon
    {
        $base = Carbon::parse($from);

        return match ($this->repeat_type) {
            'daily'   => $base->addDays($this->repeat_interval),
            'weekly'  => $base->addWeeks($this->repeat_interval),
            'monthly' => $base->addMonths($this->repeat_interval),
            default   => null,
        };
    }

    // ⚡️ إمكانية تحديد إن كانت النشرة جاهزة للإرسال
    public function shouldBeSent(): bool
    {
        return !$this->is_sent && $this->send_at && now()->gte($this->send_at);
    }
}
