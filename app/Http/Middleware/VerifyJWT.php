<?php

namespace App\Http\Middleware;

use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\GetUserFromToken;


class VerifyJWT extends GetUserFromToken
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        $user = null;
        if ($request->expectsJson()) {
            if (!$token = $this->auth->setRequest($request)->getToken()) {
                $this->tokenFailureHandler();
            }
            try {
                $user = $this->auth->authenticate($token);
            } catch (TokenExpiredException $e) {
                $this->tokenFailureHandler();
            } catch (JWTException $e) {
                $this->tokenFailureHandler();
            }

            if (!$user) {
                return $this->respond('tymon.jwt.user_not_found', 'user_not_found', 404);
            }

            $this->events->fire('tymon.jwt.valid', $user);

            return $next($request);
        }

        // If there is any custom Implementation on non Ajax
        return parent::handle($request, $next);
    }
}
