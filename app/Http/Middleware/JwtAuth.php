<?php

namespace App\Http\Middleware;

use Closure;

class JwtAuth
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
        try{
            \Tymon\JWTAuth\Facades\JWTAuth::parseToken()->authenticate();

        }catch (\Exception $ex){
           if ($ex instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
               return response()->json(['status' => 'Invalid Token ']);
           }
           else if ($ex instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
               return response()->json(['status' => 'Token is Expired']);
           }
           else {
               return response()->json(['status' => 'Token is not found ']);
           }
        }
            return $next($request);
    }
}
