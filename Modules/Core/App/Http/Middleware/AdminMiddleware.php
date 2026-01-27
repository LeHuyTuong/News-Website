<?php

namespace Modules\Core\App\Http\Middleware;

use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, \Closure $next)
    {

        $role = ['super-admin', 'editor', 'writer'];

        $user = $request->user();

        if(!$user || !$user->hasAnyRole($role)){
            abort(403, 'Unauthorized access.');
        }
        return $next($request);
    }
}