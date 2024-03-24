<?php

namespace Tests\Feature;

use Illuminate\Http\Response;
use Tests\TestCase;

class CreateShortUrlTest extends TestCase
{

    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer [](){}'
        ])->postJson('/api/v1/short-urls', [
            'url' => 'https://www.google.es/'
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_the_application_returns_bad_request_response()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer (())'
        ])->postJson('/api/v1/short-urls', [
            'url' => ''
        ]);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $this->assertFalse($response['success']);
    }
}
