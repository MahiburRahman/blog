<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Model\User;
use Closure;

class LoggedInAuthMiddleware
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
        if (!Auth::user()) {     
            return redirect()->route('login_view');
        }else{
            $userMetaInfo = User::find(Auth::user()->id)->UserMeta;
            \App::instance('userMetaInfo', $userMetaInfo);
        }
        return $next($request);
    }
}
