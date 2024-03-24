<?php

return [
    'default' => env('URL_SHORTENER_DRIVER', 'tiny_url'),
    'shorteners' => [
        'tiny_url' => [
            'driver' => 'tiny_url',
            'base_uri' => 'https://tinyurl.com',
        ],
        'bitly' => [
            'driver' => 'bitly',
            'base_uri' => 'https://api-ssl.bitly.com',
            'token' => env('URL_SHORTENER_API_TOKEN'),
            'domain' => env('URL_SHORTENER_PREFIX', 'bit.ly')
        ]
    ],
    'ttl_cache' => env('URL_SHORTENER_TTL_CACHE', 300),
];
