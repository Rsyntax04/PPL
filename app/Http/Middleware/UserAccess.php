<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (auth()->check()) {
            // Dapatkan peran pengguna saat ini
            $userRole = auth()->user()->role;

            // Cek apakah role sesuai
            if ($userRole == $role) {
                return $next($request);
            }

            // Redirect sesuai role pengguna
            switch ($userRole) {
                case 'admin':
                    return redirect()->route('krywn');
                case 'manajer':
                    return redirect()->route('manajer');
                case 'karyawan':
                    return redirect()->route('karyawan');
                default:
                    return redirect('/'); // Halaman default jika role tidak dikenali
            }
        }
    }
}
