<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $permission)
    {
        if (!auth()->check() || !auth()->user()->hasPermission($permission)) {
            return redirect()->route('home')->with('error', 'Yetkiniz yok.');
        }

        return $next($request);
    }
}
