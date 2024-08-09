<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check() || Auth::user()->role !== $role) {
            switch (Auth::user()->role) {
                case 'admin':
                    return redirect()->route('admin.welcome');
                case 'dokter':
                    return redirect()->route('dokter.welcome');
                case 'kasir':
                    return redirect()->route('kasir.welcome');
                case 'koordinator':
                    return redirect()->route('koordinator.welcome');
                case 'manajer':
                    return redirect()->route('manajer.welcome');
                case 'paramedis':
                    return redirect()->route('paramedis.welcome');
                case 'pasien':
                    return redirect()->route('pasien.welcome');
                case 'receptionst':
                    return redirect()->route('receptionst.welcome');
                default:
                    return redirect()->route('login');
            }
        }

        return $next($request);
    }
}
