<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Admin
{
    public function handle(Request $request, Closure $next): Response | JsonResponse
    {
        if ($request->user() === null) {
            return response(status: Response::HTTP_UNAUTHORIZED);
        }

        if (!$request->user()->is_admin) {
            return response(status: Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
