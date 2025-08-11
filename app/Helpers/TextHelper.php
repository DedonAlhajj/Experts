<?php

namespace App\Helpers;

class TextHelper
{
    public static function isArabic(string $text): bool
    {
        return preg_match('/[\x{0600}-\x{06FF}]/u', $text) > 0;
    }
}
