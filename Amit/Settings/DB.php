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
class DB {

    public static function getBucketName() {
        return env('CB_BUCKETNAME');
    }

    public static function getHostName() {
        return env('CB_HOST');
    }

    public static function getCouchEnviroment() {
        return env("CB_ENVIRONMENT");
    }

}
