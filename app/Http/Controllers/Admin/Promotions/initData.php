<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Admin\Promotions;

/**
 * Description of initData
 *
 * @author jooaziz
 */
use Amit\Support\Str;

class initData {

    public static function create(\Illuminate\Http\Request $request) {
        $data = $request->except('_token');
      //  $data['code'] = Str::random(10);
        return $data;
    }
    public static function edit(\Illuminate\Http\Request $request) {
        $data = $request->except('_token');
       
        return $data;
    }

}
