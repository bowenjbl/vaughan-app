<?php

namespace Tests\Feature;

use Tests\TestCase;

class CreateShortUrlTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer [](){}'
        ])->postJson('/api/v1/short-urls', [
            'url' => 'https://www.google.es/'
        ]);

        $response->assertStatus(200);
    }
}
