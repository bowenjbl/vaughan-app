<?php

namespace Tests\Unit;

use App\Drivers\TinyUrlDriver;
use GuzzleHttp\ClientInterface;
use Illuminate\Http\Exceptions\HttpResponseException;
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

    public function test_it_create_the_same_link(): void
    {
        $link1 = $this->shortener->generate('https://www.google.es/');
        $link2 = $this->shortener->generate('https://www.google.es/');
        $this->assertEquals($link1, $link2);
    }

    public function test_failure(): void
    {
        $this->expectException(HttpResponseException::class);
        $this->shortener->generate('google');
    }
}
