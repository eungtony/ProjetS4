<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class Owner
{

    public $auth;

    public function __construct(Guard $auth){
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        $controller_name = explode('@', $request->route()->getAction()['uses'])['0'];
        $controller = app($controller_name);
        $reflection_method = new \ReflectionMethod($controller_name, 'getResource');
        $resource = $reflection_method->invokeArgs($controller, $request->route()->parameters());


        if ($resource->user_id != $this->auth->user()->id) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('/home')->with('error', "Vous n'avez pas accès à cette page !");
            }
        }

        $request->route()->setParameter($request->route()->parameterNames()['0'], $resource);

        return $next($request);
    }
}
