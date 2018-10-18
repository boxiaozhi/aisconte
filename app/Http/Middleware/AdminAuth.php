<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class AdminAuth extends BaseMiddleware
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
        $resJson = $request->expectsJson();
        //设置 jwt
        if($request->hasCookie('jwt_token')){
            $request->headers->set('Authorization', 'Bearer '.$request->cookie('jwt_token'));
        }

        //校验是否存在token
        try{
            $this->checkForToken($request);
        } catch(\Exception $e){
            if($resJson){
                return response()->json(['error' =>'请登录'], 401);
            } else {
                return redirect(route('admin.login.index'));
            }
        }

        // 使用 try 包裹，以捕捉 token 过期所抛出的 TokenExpiredException  异常
        try {
            // 检测用户的登录状态，如果正常则通过
            if ($this->auth->parseToken()->authenticate()) {
                return $next($request);
            }
            if($resJson){
                return response()->json(['error' =>'请登录'], 401);
            } else {
                return redirect(route('admin.login.index'));
            }
        } catch (TokenExpiredException $exception) {
            // 此处捕获到了 token 过期所抛出的 TokenExpiredException 异常，我们在这里需要做的是刷新该用户的 token 并将它添加到响应头中
            try {
                // 刷新用户的 token
                $token = $this->auth->refresh();
                //cookie('jwt_token', $token);
                return $this->setAuthenticationHeader($next($request), $token)->cookie('jwt_token', $token);
            } catch (JWTException $exception) {
                // 如果捕获到此异常，即代表 refresh 也过期了，用户无法刷新令牌，需要重新登录。
                if($resJson){
                    return response()->json(['error' =>'请重新登录'], 401);
                } else {
                    return redirect(route('admin.login.index'));
                }
            }
        } catch(\Exception $e){
            if($resJson){
                return response()->json(['error' =>'请重新登录'], 401);
            } else {
                return redirect(route('admin.login.index'));
            }
        }
    }
}
