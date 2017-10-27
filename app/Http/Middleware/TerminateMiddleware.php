<?php

namespace App\Http\Middleware;

use Closure;

class TerminateMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        return $next($request);
    }

    public function terminate($request, $response) {
        if ($this->sessionHandled && $this->sessionConfigured() && !$this->usingCookieSessions()) {
            $this->manager->driver()->save();
        }
    }
}