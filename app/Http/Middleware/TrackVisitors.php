<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ambil jumlah visitor dari cache, default 0 jika belum ada
        $visitorCount = Cache::get('visitor_count', 0);

        // Tambah jumlah visitor
        Cache::put('visitor_count', $visitorCount + 1, now()->addWeek()); // Reset tiap minggu

        return $next($request);
    }
}
