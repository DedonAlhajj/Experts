<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Setting extends Model
{
    use HasFactory;
    protected $fillable = ['key', 'value' , 'type','description', 'editable'];


    public static function get(string $key, $default = null): mixed
    {
        return cache()->remember("setting:$key", 3600, fn() =>
            static::query()->where('key', $key)->value('value') ?? $default
        );
    }

    public static function forget(string $key): void
    {
        cache()->forget("setting:$key");
    }
}
