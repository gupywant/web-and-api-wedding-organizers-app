<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\User;

class UserHasLogin
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
        $data = User::where('token',$request->token)->first();
        if(!empty($data)){
            return $next($request);
        }else{
            return redirect("api/invalid");
        }
    }
}
