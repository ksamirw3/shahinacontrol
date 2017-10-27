<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\CustomeValidations;

/**
 * Description of Base
 *
 * @author PHP_Developer
 */
use Illuminate\Foundation\Validation\ValidatesRequests;

class Base {

    use ValidatesRequests;

    protected $model;

    public function __construct() {

    }

}
