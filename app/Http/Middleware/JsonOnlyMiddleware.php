<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JsonOnlyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request->headers->set('Accept', 'application/json');
        $request->headers->set('Content-Type', 'application/json');

        if (!$request->isJson()) {
            return response()->json(
                ['message' => 'Only JSON requests are allowed.'],
                Response::HTTP_UNSUPPORTED_MEDIA_TYPE,
            );
        }

        return $next($request);
    }
}
