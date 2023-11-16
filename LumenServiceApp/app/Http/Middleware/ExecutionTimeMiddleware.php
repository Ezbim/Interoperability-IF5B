<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Log;

class ExecutionTimeMiddleware
{
    public function handle($request, \Closure $next)
    {
        $start = microtime(true);

        $response = $next($request);

        $end = microtime(true);
        $executionTime = $end - $start;

        Log::info('Waktu eksekusi: ' . $executionTime . ' detik');

        return $response;
    }
}
