<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpertInfo extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'category',
        'title',
        'institution',
        'description',
        'attachment_url',
        'title_normalized',
        'start_date',
        'end_date',
    ];


    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];



    // العلاقة مع المستخدم (الخبير)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
