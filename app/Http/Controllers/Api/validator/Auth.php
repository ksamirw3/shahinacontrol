<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Api\validator;

/**
 * Description of Auth
 *
 * @author jooaziz
 */
class Auth extends Base {

    protected $myUrl = 'api/auth/';

    public function rules() {

        if (request()->is($this->myUrl . 'register')) {
            return self::register();
        }
        return [];
    }

    private static function register() {
        dd('sdf');
        return [

            'username' => 'required|regex:/^[A-Za-z0-9@-_.]+$/|couch_uniqu:user,by_username',
            'email' => 'required|email|couch_uniqu:user,by_email',
            'password' => 'required|min:8',
            'name' => 'required',
            'phone' => 'digits_between:4,12',
        ];
    }

}
