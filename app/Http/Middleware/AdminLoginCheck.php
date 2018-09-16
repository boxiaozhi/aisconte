<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class AdminLoginCheck extends BaseMiddleware
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
        $currentRouteName = $request->route()->getName();
        if(in_array($currentRouteName, ['admin.login.logout'])) {
            return $next($request);
        }
        //设置 jwt
        if($request->hasCookie('jwt_token')){
            $request->headers->set('Authorization', 'Bearer '.$request->cookie('jwt_token'));
        }

        // 检测用户的登录状态，如果正常则通过
        try{
            if ($this->auth->parseToken()->authenticate()) {
                return redirect(route('admin.dashboard.index'));
            }
        } catch(\Exception $e){
            return $next($request);
        }
    }
}
