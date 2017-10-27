<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Amit\Settings;

/**
 * Description of API
 *
 * @author jooaziz
 */
class API {

    public static function appKeyIs($checkKey) {
        if ($checkKey == '123') return true;
        return false;
    }

}
