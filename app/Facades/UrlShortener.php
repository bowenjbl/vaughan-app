<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class UrlShortener extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'urlshortener';
    }
}
