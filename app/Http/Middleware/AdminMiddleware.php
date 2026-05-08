<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->role !== 'admin') { //validasi role user, hanya user dengan role admin yang bisa mengakses route yang menggunakan middleware ini
            return response()->json([
                'message' => 'Akses ditolak, Anda bukan admin'
            ], 403);
        }
        return $next($request);
    }
}
