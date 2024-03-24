<?php

namespace App\Http\Controllers\Api\V1;

use App\Facades\UrlShortener;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateShortUrlController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $url = $request->input('url');
        $shortenedUrl = UrlShortener::get($url);
        return response()->json([
            'url' => $shortenedUrl
        ]);
    }
}
