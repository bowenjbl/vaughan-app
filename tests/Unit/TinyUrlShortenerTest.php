<?php

namespace Tests\Unit;

use App\Drivers\TinyUrlDriver;
use GuzzleHttp\ClientInterface;
use Tests\TestCase;

class TinyUrlShortenerTest extends TestCase
{
    protected TinyUrlDriver $shortener;

    public function setUp(): void
    {
        parent::setUp();
        $this->shortener = new TinyUrlDriver($this->app->make(ClientInterface::class), $this->app['config']["urlshortener.shorteners.tiny_url"]);
    }

    public function test_the_shorten_url_is_not_empty(): void
    {
        $shortenedUrl = $this->shortener->generate('https://www.google.es/');
        $this->assertNotEmpty($shortenedUrl);
        $this->assertNotNull($shortenedUrl);
    }
}
