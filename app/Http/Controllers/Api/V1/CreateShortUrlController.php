<?php

namespace App\Http\Controllers\Api\V1;

use App\Facades\UrlShortener;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\CreateShortUrlRequest;
use Illuminate\Http\JsonResponse;

class CreateShortUrlController extends Controller
{
    public function __invoke(CreateShortUrlRequest $request): JsonResponse
    {
        $url = $request->input('url');
        $shortenedUrl = UrlShortener::get($url);
        return response()->json([
            'url' => $shortenedUrl
        ]);
    }
}
