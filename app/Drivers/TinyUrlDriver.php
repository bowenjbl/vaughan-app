<?php

namespace App\Drivers;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Exceptions\HttpResponseException;

final class TinyUrlDriver extends BaseDriver
{
    public function generate(string $url): string
    {
        $options = [
            'base_uri' => $this->config['base_uri'],
            'query' => [
                'url' => $url
            ]
        ];
        $request = new Request('GET', '/api-create.php');
        try {
            $response = $this->client->send($request, $options);
        } catch (GuzzleException $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], $e->getCode()));
        }
        return $response->getBody()->getContents();
    }
}
