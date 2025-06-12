<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            session()->flash('error', 'Silakan login terlebih dahulu.');
            return redirect()->route('login');
        }

        if (Auth::user()->role !== $role) {
            session()->flash('error', 'Anda tidak memiliki akses ke halaman tersebut.');
            return redirect()->back();
        }

        return $next($request);
    }
}
