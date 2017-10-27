<?php

namespace Amit\CouchBase;

/**
 * Description of couchbaseconnection
 *
 * @author Developer
 */
class CouchbaseConnect {

    // connection to couchbase (static-shared)
    private static $cb;

    public function __clone() {

    }

    public static function connect() {
        if (is_null(self::$cb)) {
            try {
                $cluster = new \CouchbaseCluster(env('CB_HOST'));
                self::$cb = $cluster->openBucket(env('CB_BUCKETNAME'), '');
                return self::$cb;
            }
            catch (\CouchbaseException $exc) {
                ExeptionHandler::jsExiptionViewer($exc->getMessage());
            }
        }
        else {
            return self::$cb;
        }
    }
}