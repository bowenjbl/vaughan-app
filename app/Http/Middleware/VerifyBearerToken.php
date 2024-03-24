<?php

namespace App\Http\Middleware;

use App\Helpers\BearerToken;
use Closure;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyBearerToken
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $validation = BearerToken::validate($request);
        if (!$validation) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'BearerToken: Invalid Token',
            ], Response::HTTP_UNAUTHORIZED));
        }
        return $next($request);
    }
}
