<?php

namespace App\Drivers;

use App\Contracts\Shortener;
use GuzzleHttp\ClientInterface;

abstract class BaseDriver implements Shortener
{
    public function __construct(protected readonly ClientInterface $client, protected readonly array $config)
    {
        //
    }
}
