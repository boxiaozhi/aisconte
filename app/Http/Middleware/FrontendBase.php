<?php
/**
 * Date: 2018/11/1
 * Time: 21:25
 */

namespace App\Http\Middleware;

use Closure;

class FrontendBase
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
    }
}