<?php

namespace App\Http\Middleware;

use App\Core\Models\Permission;
use Closure;
use Gate;

class IsCanSeeAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $permission
     * @return mixed
     */
    public function handle($request, Closure $next, $permission = 'VIEW_ADMIN')
    {
	    if (Gate::denies($permission)) {
		    abort(403, 'Доступ запрещен из посредника');
	    }
        return $next($request);
    }

}//IsCanSeeAdmin
