<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        foreach($request->user()->roles->pluck('name') as $role) {
            if(!$role == 'Администратор'){
                return redirect()->back()->with('error', 'Доступ к разделу администратора запрещен! Недостаточно прав.');
            }
        }
        return $next($request);
    }
}
