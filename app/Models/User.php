<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\HandlesMediaUploads;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class User extends Authenticatable implements HasMedia , MustVerifyEmail
{
    use InteractsWithMedia,HandlesMediaUploads,HasSlug;

    use HasApiTokens, HasFactory, Notifiable;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('profile_image')->useDisk('profile_image')->singleFile(); // تحديد القرص الخاص بهذا الموديل
        $this->addMediaCollection('cv_file')->useDisk('cv_file')->singleFile(); // تحديد القرص الخاص بهذا الموديل
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'slug',
        'country',
        'city',
        'nationality',
        'address',

        'gender',
        'date_of_birth',
        'profile_image',
        'bio',

        'is_expert',
        'is_job_seeker',
        'cv_file',
        'social_links',
        'available_for_remote',
        'is_active',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_expert' => 'boolean',
        'is_job_seeker' => 'boolean',
        'available_for_remote' => 'boolean',
        'is_active' => 'boolean',
        'is_admin' => 'boolean',
        'date_of_birth' => 'date',
        'social_links' => 'array',
    ];





    // app/Models/User.php

    public function getIsExpertLabelAttribute()
    {
        return $this->is_expert ? 'Expert' : 'Not an Expert';
    }

    public function getIsJobSeekerLabelAttribute()
    {
        return $this->is_job_seeker ? 'Job Seeker' : 'Not Seeking Jobs';
    }

    public function getIsAvailableForRemoteAttribute()
    {
        return $this->available_for_remote ? 'Available For Remote' : 'Not Available For Remote';
    }

    public function getIsAdminTextAttribute(): string
    {
        return $this->is_admin ? 'Administrator' : 'Regular User';
    }
    public function getIsActiveTextAttribute(): string
    {
        return $this->is_active ? 'Active Account' : 'Inactive Account';
    }


    //$groupedInfos = $user->infos->groupBy('category');
    public function infos()
    {
        return $this->hasMany(ExpertInfo::class);
    }


    public function skills()
    {
        return $this->hasMany(ExpertInfo::class)->where('category', 'skill');
    }

    public function certificates()
    {
        return $this->hasMany(ExpertInfo::class)->where('category', 'certificate');
    }

    public function portfolios()
    {
        return $this->hasMany(ExpertInfo::class)->where('category', 'portfolio');
    }

    public function experiences()
    {
        return $this->hasMany(ExpertInfo::class)->where('category', 'experience');
    }


    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')      // توليد slug من الاسم
            ->saveSlugsTo('slug')            // حفظه في عمود slug
            ->slugsShouldBeNoLongerThan(50)  // (اختياري) تحديد الطول الأقصى للـ slug
            ->usingSeparator('-')            // فاصل بين الكلمات
            ->allowDuplicateSlugs(false);     // تجنب التكرار تلقائيًا
    }

    public function scopeExperts($query)
    {
        return $query->where('is_expert', 1);
    }

    // App\Models\User.php

    public function scopeJobSeekers($query)
    {
        return $query->where('is_job_seeker', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    public function scopeAdminsOnly($query)
    {
        return $query->where('is_admin', true);
    }
    public function scopeNotAdmin($query)
    {
        return $query->where('is_admin', false);
    }

    public function getProfileImageUrlAttribute(): ?string
    {
        return $this->getFirstMediaUrl('profile_image');
    }

    public function getCvFileUrlAttribute(): ?string
    {
        return $this->getFirstMediaUrl('cv_file');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

}
