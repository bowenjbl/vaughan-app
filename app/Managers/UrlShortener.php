<?php

namespace App\Managers;

use App\Drivers\BitlyDriver;
use App\Drivers\TinyUrlDriver;
use GuzzleHttp\ClientInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use InvalidArgumentException;

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

    protected function createBitlyDriver(array $config)
    {
        return new BitlyDriver($this->app->make(ClientInterface::class), $config);
    }

    protected function resolveDriver($name)
    {
        $config = $this->app['config']["urlshortener.shorteners.{$name}"];
        if (is_null($config)) {
            throw new InvalidArgumentException("Driver: {$name} not defined");
        }
        $methodName = 'create' . Str::studly($config['driver']) . 'Driver';

        if (method_exists($this, $methodName))
            return $this->{$methodName}($config);

        throw new InvalidArgumentException("Driver [{$config['driver']}] is not supported.");
    }

    public function get(string $url): string
    {
        $shortener = $this->app['config']['urlshortener.default'];
        $hash = md5($shortener . ":" . $url);
        $ttl = $this->app['config']['urlshortener.ttl_cache'];
        if (Cache::has($hash)) {
            $response = Cache::get($hash);
        } else {
            $response = $this->driver->generate($url);
            Cache::put($hash, $response, $ttl);
        }
        return $response;
    }
}
