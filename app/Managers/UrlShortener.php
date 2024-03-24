<?php

namespace App\Managers;

use App\Drivers\TinyUrlDriver;
use GuzzleHttp\ClientInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Str;

class UrlShortener
{
    protected $driver;

    public function __construct(
        protected Application $app,
        protected string      $shortener
    )
    {
        $this->driver = $this->resolveDriver($this->shortener);
    }

    protected function createTinyUrlDriver(array $config): TinyUrlDriver
    {
        return new TinyUrlDriver($this->app->make(ClientInterface::class), $config);
    }

    protected function resolveDriver($name)
    {
        $methodName = 'create' . Str::studly($name) . 'Driver';
        return $this->{$methodName}([]);
    }

    public function get(string $url): string
    {
        return $this->driver->generate($url);
    }
}
