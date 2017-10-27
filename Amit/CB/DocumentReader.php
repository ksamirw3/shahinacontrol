<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Amit\CB;

/**
 * Description of DocumentReader
 *
 * @author jooaziz
 */
class DocumentReader {

    public static function get($IDs) {
        try {
            $con = \Amit\CB\DB::connect();
            if ($con) return Helper::reformatResult($con->get($IDs), $IDs);
        } catch (\CouchbaseException $exc) {
            ExeptionHandler::jsExiptionViewer($exc->getMessage());
            return null;
        }
    }

}
