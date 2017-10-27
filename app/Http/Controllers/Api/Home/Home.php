<?php

namespace App\Http\Controllers\Api\Home;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Home
 *
 * @author jooaziz
 */
class Home extends \App\Http\Controllers\Api\Base {

    public function index() {
        return response()->json([
                    'Api' => env('SITE_NAME') . ' API ',
                    'version' => '2.0.0',
                    'baseUrl' => url('/api'),
                    'baseImageUrl' => url('/') . '/uploads'
            ]
        );
    }

    public function error() {
        return response()->json([ 'Api' => 'AMIT API ', 'version' => '1.1', 'giude' => url('/api') . '/guide']);
    }

    public function guide() {
        $arr = [
            'baseUrl' => url('/api'),
            'baseImageUrl' => url('/') . '/uploads',
            'codes guide' => [
                '200' => 'success',
                '401' => 'unauthorized',
                '404' => 'page not found',
                '403' => 'validation error',
                '2100' => 'required/format fields/fields needed',
                '2101' => 'User exist with this username',
                '2102' => ' User exist with this email',
                '2103' => 'Invalid username',
                '2104' => 'Invalid password',
                '2105' => 'User not activated',
                '2106' => 'Account with this email is not exist',
                '2107' => 'Account with this username is not exist',
                '2108' => 'Invalid old password',
                '2109' => 'User exist with this telephone',
                '2110' => ' empty cart',
                '2112' => 'invalid username or email',
                '2113' => 'invalid username formate',
            ]
        ];
        return response()->json($arr);
    }

}

/*
