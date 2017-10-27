<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Admin;

/**
 * Description of Base
 *
 * @author PHP_Developer
 */
class Base extends \App\Http\Controllers\Controller {

    public function __construct() {
        parent::__construct();
        \App\Http\Authantications\AdminAuth::authanticationRequired();
    }

    protected static function view($data = array()) {
        $data['auth'] = \App\Http\Authantications\AdminAuth::class;
        return parent::view($data);
    }

}
