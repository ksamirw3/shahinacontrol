<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use App\Models\CouchModel;

class ApiAuthenticate {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $token = $request->input("token");
        if (!$token) {
            return response()->json(['message' => __("api.Invalid User token")], 401);
        }


        $couch = new \App\Models\Couch\User();

        $row = array_values($couch->getByToken($token, "user"));

        if (!@$row[0]) {
            $message = __('Api.Unauthorized user.');
            return response()->json(['message' => $message], 401);
        }
        return $next($request);
    }

}
