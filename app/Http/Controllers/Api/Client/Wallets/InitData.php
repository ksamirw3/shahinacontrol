<?php

namespace App\Http\Controllers\Api\Client\Wallets;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class InitData {

    public static function createData() {
        $req = request()->except('_token');
        $data['password'] = \Hash::make($req['password']);
        $data['email'] = $req['email'];
//        $data['username'] = $req['username'];
        $data['phone'] = $req['phone'];
        $data['f_name'] = $req['f_name'];
        $data['active_token'] = \Amit\Support\UUID::v4();
        $data['active'] = 0;
        return $data;
    }

    public static function updateToken($row, $type) {
        $row->token = request()->token;
        $row->token_type = $type;
        $row->save();
    }

}
