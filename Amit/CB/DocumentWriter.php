<?php

namespace Amit\CB;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DocumentWriter
 *
 * @author jooaziz
 */
class DocumentWriter {

    private static function connection() {
        $con = \Amit\CB\DB::connect();
        if (is_null($con)) return abort(404, 'Lost Conection');
        return $con;
    }

    public static function write($data, $documentId = null) {
        $con = self::connection();
        try {
            $id = self::makeID($data['type'] . '::', $documentId);
            $res = $con->upsert($id, json_decode(json_encode($data, JSON_NUMERIC_CHECK)));
            return $id;
        } catch (\CouchbaseException $exc) {
            ExeptionHandler::jsExiptionViewer($exc->getMessage());
            return abort(404, 'AMIT : some thing happend in insert data');
        }
    }

    private static function makeID($prefix, $id) {
        if (!is_null($id)) return $id;
        return \Amit\Support\UUID::v4($prefix);
    }

    public static function remove($id) {
        $con = self::connection();

        try {

            return $con->remove($id);
        } catch (\CouchbaseException $exc) {
            ExeptionHandler::jsExiptionViewer($exc->getMessage());
            return abort(404, 'AMIT : some thing happend in remove document');
        }
    }

}
