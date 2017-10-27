<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Authantications;

/**
 * Description of ApiAuth
 *
 * @author jooaziz
 */
use \Illuminate\Support\Facades\Request as R;

class ApiAuth {

    public static function authanticat() {

        if (R::is('api/guide') || R::is('api/error')) return true;

        if (is_null(R::get('app_key')) || R::get('app_key') == '') return redirect('api/error')->send();
    }

}

/*
   $token = $request->input("token");
        if (!$token) {
            return response()->json(['message' => __("api.Invalid User token")],
                    401);
        }
        $couch = new \App\Models\Couch\User();
        $row = array_values($couch->getByToken($token, "user"));
        if (!@$row[0]) {
            $message = __('Api.Unauthorized user.');
            return response()->json(['message' => $message], 401);
        }
        return $next($request);