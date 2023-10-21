<?php
namespace App\Http\Middleware;

class ValidationMiddleware
{
    public function handle($request, \Closure $next)
    {
        $data = $request->all();

        // Validasi data
        if (empty($data['field'])) {
            return response('Data tidak valid', 400);
        }

        return $next($request);
    }
}
