<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\Store;
use Illuminate\Contracts\Auth\Guard;

class Authenticate {

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;
    
    /**
     * Store Object
     * @var Session
     */
    protected $session;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth, Store $session)
    {
        $this->auth = $auth;
        $this->session = $session;
    }

    /**
     * Handles an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->session->has('user_authenticated.token')) {
            return $next($request);			
        }
        else {
            return redirect('/');
        }
    }
}
