<?php

namespace App\Http\Middleware;

use App\Cours;
use Closure;
use Illuminate\Support\Facades\DB;

class online
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
        dd($request->route()->parameters());
        $cours_slug = $request->route()->parameters()['slug'];
        $cours = Cours::where('cours_slug', $cours_slug)->get()[0];
        if($cours->online == 1){
            return $next($request);
        }
        return redirect()->guest('/home')->with('error', "Ce cours n'est plus accessible !");
    }
}
