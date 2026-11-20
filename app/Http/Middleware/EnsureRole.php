<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    /**
     * Pakai sebagai middleware('role:admin') atau middleware('role:admin,kontributor').
     * Tamu diarahkan ke login; role lain ditolak 403.
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        if (! in_array($user->role, $roles, true)) {
            abort(403, 'Akses ditolak: perlu role ' . implode(' atau ', $roles) . '.');
        }

        return $next($request);
    }
}
