<?php namespace App\Http\Middleware;

use Closure;
Use JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

class Authenticate {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
            $this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle(Request $request, Closure $next)
	{
            $apacheHeaders = apache_request_headers();
			
            if (isset($apacheHeaders['Authorization'])) {
                list($method, $token) = explode(" ", $apacheHeaders['Authorization']);
            }
            elseif (!isset($apacheHeaders['Authorization'])){
                return response()->json(["Token Invalid"], 200);
            }
  
            if (isset($token)) {
                try{
                    $user = JWTAuth::authenticate($token);
                    return $next($request);
                    exit;
                }
                catch(\Tymon\JWTAuth\Exceptions\TokenExpiredException $Exception) {
                    try {
                        JWTAuth::setToken($token)->refresh();  
                    }
                    catch(\Tymon\JWTAuth\Exceptions\TokenExpiredException $Exception) {
                        return response()->json(["Token Expired"], 200);
                        exit;
                    }
                }
                catch(\Tymon\JWTAuth\Exceptions\TokenInvalidException $Exception) {
                    return response()->json(["Token Invalid"], 200);
                }
            }
            return $next($request);
	}
}
