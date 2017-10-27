<?php

namespace App\Http\Controllers\Api\validator;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Base
 *
 * @author jooaziz
 */
use Validator;

abstract class Base {

    protected $request;

    public function __construct(\Illuminate\Http\Request $request) {
        $validator = Validator::make($request->all(), $this->rules());
        if ($validator->fails()) {
            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode(['message' => $validator->errors(), 'code' => '2100']);
            die;
        }
        return TRUE;
    }

    abstract function rules();
}
