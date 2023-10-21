<?php
namespace App\Http\Middleware;

use Closure;

class LoginMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!($request->input('username') == 'admin' && $request->input('password') == 'admin')) {
            return "Anda tidak di ijinkan untuk mennegakses halaman ini";
        }
        return $next($request);
    }
}