<?php

namespace App\Http\Middleware;

use App\Cours;
use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class inscrit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }

        $cours_slug = $request->route()->parameters()['slugcours'];
        $cours_id = Cours::where('cours_slug', $cours_slug)->get()[0]->id;
        $in = DB::table('cours_users')
            ->where('user_id', $request->user()->id)
            ->where('cours_id', $cours_id)
            ->get();
        if(!empty($in) && Auth::user()){
            return $next($request);
        }
        return redirect()->guest('/home')->with('error', "Vous ne vous êtes pas abonné à ce cours !");
    }
}
