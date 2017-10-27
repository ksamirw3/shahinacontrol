<?php

namespace Amit\Settings;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DB
 *
 * @author jooaziz
 */
class Genral {

    public static function debuge() {
        return env('APP_DEBUG');
    }

    public static function devMode() {
        return env('DEV_MODE');
    }

    public static function getBuildNo() {
        return "#025";
    }

    public static function perPage() {
        return 10;
    }

}
