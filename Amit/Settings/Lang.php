<?php

namespace Amit\Settings;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Lang
 *
 * @author jooaziz
 */
class Lang {

    public static function getDefaultLang() {
        return env('DEFAULT_LANGUAGE');
    }

}
