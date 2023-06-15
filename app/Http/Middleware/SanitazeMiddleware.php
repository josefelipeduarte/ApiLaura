<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SanitazeMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $input = $request->all();

        array_walk_recursive($input, function (&$value) {
            $value = $this->sanitize($value);
        });

        $request->replace($input);

        return $next($request);
    }

    private function sanitize($value)
    {
        $sanitizedValue = strip_tags($value);
        $sanitizedValue = htmlspecialchars($sanitizedValue);

        return $sanitizedValue;
    }
}
