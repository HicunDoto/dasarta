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
        }elseif(auth()->user()->level != "1"){
            //dd($request->all());
            return redirect('/dashboard'); 
        }else{
            return $next($request);
        }
    }
}