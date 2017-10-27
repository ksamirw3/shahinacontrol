<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Amit\CB;

/**
 * Description of DB
 *
 * @author jooaziz
 */
class DB {

    private static $cb = null;

    public static function connect() {
        if (is_null(self::$cb)) {
            try {
                return self::$cb = (new \CouchbaseCluster(\Amit\Settings\DB::getHostName()))->
                        openBucket(\Amit\Settings\DB::getBucketName(), '');
            } catch (\CouchbaseException $exc) {
                ExeptionHandler::jsExiptionViewer($exc->getMessage());
            }
        } else {
            return self::$cb;
        }
    }

}
