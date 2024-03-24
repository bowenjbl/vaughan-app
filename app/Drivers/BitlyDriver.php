<?php

namespace App\Drivers;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Exceptions\HttpResponseException;

final class BitlyDriver extends BaseDriver
{
    public function generate(string $url): string
    {
        $options = [
            'base_uri' => $this->config['base_uri'],
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => "Bearer {$this->config['token']}",
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'domain' => $this->config['domain'],
                'long_url' => $url
            ],
        ];
        $request = new Request('POST', '/v4/shorten');
        try {
            $response = $this->client->send($request, $options);
            $jsonResponse = json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], $e->getCode()));
        }
        return $jsonResponse['link'] ?? '';
    }
}
