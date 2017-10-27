<?php

namespace Amit\Support;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Str
 *
 * @author jooaziz
 */
class Str extends \Illuminate\Support\Str {

    public static function ClassCase($value) {
        return ucfirst(parent::camel(str_replace("_", ' ', $value)));
    }

}
