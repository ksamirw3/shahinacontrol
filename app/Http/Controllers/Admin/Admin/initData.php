<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Admin\Admin;

/**
 * Description of initData
 *
 * @author jooaziz
 */
class initData {

    public static function create(\Illuminate\Http\Request $request) {
        $data = $request->except(['_token', 'id', 'password_confirmation']);
        $data['password'] = \Hash::make($data['password']);
        return $data;
    }

}
