<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Sales
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
            return redirect('/')->with('status', 'Mohon Login Terlebih Dahulu!');; 
        }elseif(auth()->user()->level != "0"){
            //dd($request->all());
            return redirect('/program'); 
        }else{
            return $next($request);
        }
    }
}