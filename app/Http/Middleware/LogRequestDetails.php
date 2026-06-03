<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class LogRequestDetails
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        Log::info('Post view resource accessed', [
            'method' => $request->method(),
            'url' => $request->url(),
            'user_id' => auth()->id(),
            'status' => $response->getStatusCode(),
            'timestamp' => now()->toDateTimeString()
        ]);
        return $response;
    }
}
