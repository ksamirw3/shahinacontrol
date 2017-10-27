<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Amit\CB;

/**
 * Description of ViewReader
 *
 * @author jooaziz
 */
class ViewReader {

    private static $viewDoc;

    public static function get($viewDocName, $viewName, $arrayQuery = NULL) {

        self::setViewDoc($viewDocName);
        try {
            return self::result($viewName, self::initQuery($arrayQuery));
        } catch (\CouchbaseException $exc) {
            ExeptionHandler::jsExiptionViewer($exc->getMessage());
            return (object) ["total_rows" => 0, "rows" => [], 'withError' => true];
        }
    }

    private static function setViewDoc($view) {
        self::$viewDoc = (\Amit\Settings\DB::getCouchEnviroment() != 'Production') ? 'dev_' . $view : $view;
    }

    private static function initQuery($q) {
        if (is_null($q)) return [];
        foreach ($q as $k => &$v) {
            if (in_array($k, array("key", "keys", "startkey", "endkey"))) $v = stripslashes(json_encode($v, JSON_UNESCAPED_UNICODE));
        }
//        dd('ss', $q);
        return $q;
    }

    private static function count($viewName, $arrayQuery) {
        return 88;
    }

    private static function result($viewName, $arrayQuery) {
        $con = DB::connect();
        if (is_null($con)) return abort(404, 'Lost Conection');
        return (object) $con->query(\CouchbaseViewQuery::from(self::$viewDoc, $viewName)->custom($arrayQuery), null, true);
    }

}
