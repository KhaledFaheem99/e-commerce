<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ApiResponse\ApiController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware extends ApiController {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || Auth::user()->role !== 'User') {
            return $this->failedResponse('User Only' , 400);
        }
        return $next($request);
    }
}
