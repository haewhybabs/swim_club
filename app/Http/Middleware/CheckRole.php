<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use PharIo\Manifest\Author;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user();
        if (! $user) {
            return redirect('/login');
        }
        if (! in_array($user->role->name, $roles)) {
            
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
