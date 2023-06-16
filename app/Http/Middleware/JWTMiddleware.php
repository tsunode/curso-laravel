<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTMiddleware {

  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next) {
    try {
      JWTAuth::parseToken()->authenticate();
    } catch (JWTException $error) {
      if($error instanceof TokenInvalidException) {
        return response()->json(['message' => 'Token inváido'], 498);
      }

      if($error instanceof TokenExpiredException) {
        return response()->json(['message' => 'Token expirado'], 401);
      }

      return response()->json(['message' => $error->getMessage()], 500);
    }

    return $next($request);
  }
}
