<?php

namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class Setting extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'setting';
    }
}
