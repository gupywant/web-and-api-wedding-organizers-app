<?php

namespace App\Http\Middleware;

use Closure;

class SessionHasAdmin
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
        if($request->session()->exists('admin')) {
            return $next($request);
        }else{
            if(session('message')){
                return redirect('login')->with('alert','Username atau Password salah!!!');
            }else{
                return redirect('login')->with('alert','Login Terlebih Dahulu');
            }
        }
    }
}
