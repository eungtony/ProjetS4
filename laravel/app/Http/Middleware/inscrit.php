<?php

namespace App\Http\Middleware;

use App\Cours;
use Closure;
use Illuminate\Support\Facades\DB;

class inscrit
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
        $cours_slug = $request->route()->parameters()['slugcours'];
        $cours_id = Cours::where('cours_slug', $cours_slug)->get()[0]->id;
        $in = DB::table('cours_users')
            ->where('user_id', $request->user()->id)
            ->where('cours_id', $cours_id)
            ->get();
        if(!empty($in)){
            return $next($request);
        }
        return redirect()->guest('/home')->with('error', "Vous ne vous êtes pas abonné à ce cours !");
    }
}
