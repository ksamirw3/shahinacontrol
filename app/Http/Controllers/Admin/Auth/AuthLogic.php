<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Admin\Auth;

/**
 * Description of AuthLogic
 *
 * @author jooaziz
 */
class AuthLogic {

    public static function isValid($request, $user) {
        $rt['status'] = false;
        if (!$user) {
            $rt['message'] = __('admin.email is not exist');
        }
        elseif (!$user->active) {
            $rt['message'] = __('admin.Account is not active Please contact your manager to activate your account');
        }
        else if (!\Hash::check($request->input('password'), $user->password)) {
            $rt['message'] = __('admin.wrong password');
        }
        else {
            $rt['status'] = TRUE;
            $rt['message'] = __('admin.welcome');
        }
        // dd($rt);
        return (object) $rt;
    }
}