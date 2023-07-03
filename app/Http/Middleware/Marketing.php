<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Marketing
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ( ! auth()->user() ){
            return redirect('/login')->with('status', 'Mohon Login Terlebih Dahulu!');; 
        }
        elseif(auth()->user()->level == "Marketing"){
            //dd($request->all());
            return $next($request);
        }else{
            return redirect('/dashboard'); 
        }
    }
}