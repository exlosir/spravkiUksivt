<?php

namespace App\Http\Middleware;

use Closure;

class secretary
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
            if($role == 'Секретарь отделения'){
                return $next($request);
            }
        }
        return redirect()->back()->withErrors(array('Ошибка доступа' => 'Доступ запрещен! Недостаточно прав.'));
    }
}
