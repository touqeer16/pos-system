<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CacheMiddleware {
    public function handle(Request $request, Closure $next) {
        $key = 'products_list';
        return Cache::remember($key, 60, function () use ($next, $request) {
            return $next($request);
        });
    }
}