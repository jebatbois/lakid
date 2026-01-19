<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user login DAN emailnya sesuai email Admin Dinas
        if (Auth::check() && Auth::user()->email === 'admin@lakid.kepri.prov.go.id') {
            return $next($request);
        }

        // Jika bukan, lempar error 403 atau kembalikan ke dashboard biasa
        return redirect('/dashboard')->with('error', 'Akses Ditolak. Anda bukan Admin.');
    }
}