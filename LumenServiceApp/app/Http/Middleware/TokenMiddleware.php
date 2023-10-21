<?php
namespace App\Http\Middleware;

class TokenMiddleware
{
    public function handle($request, \Closure $next)
    {
        $token = $request->header('Authorization');

        if ($token !== 'Bearer my-secret-token') {
            return response('Token tidak valid', 401);
        }

        return $next($request);
    }
}
