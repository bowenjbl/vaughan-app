<?php

return [
    'default' => env('URL_SHORTENER_DRIVER', 'tiny_url'),
    'shorteners' => [
        'tiny_url' => [
            'driver' => 'tiny_url',
            'base_uri' => 'https://tinyurl.com',
        ],
    ]
];
