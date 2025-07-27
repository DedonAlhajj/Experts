<?php

namespace App\Helpers;


class EmailTypos
{
    protected static array $typos = [
        'gmial.com'   => 'gmail.com',
        'yahooo.com'  => 'yahoo.com',
        'hotmal.com'  => 'hotmail.com',
        'outlok.com'  => 'outlook.com',
    ];

    public static function suggest(string $domain): ?string
    {
        return self::$typos[strtolower($domain)] ?? null;
    }
}
