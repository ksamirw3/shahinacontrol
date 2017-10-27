<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Api\Auth;

/**
 * Description of initData
 *
 * @author jooaziz
 */
class initData {

    public static function register(\Illuminate\Http\Request $request) {
        $data = $request->except('app_key');

        $data['password'] = \Hash::make($data['password']);
        $data['confirm_token'] = md5(rand(1000000, 999999999)) . md5($data['email']) . md5(time());
        $data['token'] = md5(rand(1000000, 999999999)) . md5($data['email']) . md5(time());
        $data['activated'] = 0;
        $data['name'] = $request->input('name');
        $data['gender'] = (!empty($request->input('gender'))) ? $request->input('gender') : 'o';
        $data['wishlist'] = [];
        $country = (!empty($request->input('country'))) ? $request->input('country') : "AE";
        $data['country'] = $country;
        $data['selected_country'] = array($country);
        return $data;
    }

}
