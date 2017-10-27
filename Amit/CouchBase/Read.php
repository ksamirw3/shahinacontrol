<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Amit\CouchBase;

/**
 * Description of Read
 *
 * @author PHP_Developer
 */
class Read {

    private $viewDocName;

    private function connect() {
        return CouchbaseConnect::connect();
    }

    public function get($IDs) {
        try {
            $res = $this->connect()->get($IDs);

            if (is_array($res)) {
                $rt = $this->reformatForBulkResult($res);
            } else {
                $rt = $this->reformatForSingelResult($res);
                $rt->id = $IDs;
            }
            return $rt;
        } catch (\CouchbaseException $exc) {
            ExeptionHandler::jsExiptionViewer($exc->getMessage());
            return null;
        }
    }

    protected function reformatForBulkResult($arr) {
        $rt = [];
        $count = 0;
        foreach ($arr as $k => $v) {
            $row = $this->reformatForSingelResult($v, true);
            $row->id = $k;
            $rt[$k] = $row;
            $count++;
        }
        return $rt;
    }

    protected function reformatForSingelResult($res, $t = false) {
//        if ($t) dd($res);
        if (is_string($res->value)) $res->value = json_decode($res->value);
        return (object) $res->value;
    }

    /**
     *  retreve data from bucket as @array Query showen
     *
     *  $arrayQuery[
     *              'key'=>string
     *              'keys'=>[]
     *              'startkey'=>mix (string - [])
     *              'endkey'=>mix (string - [])
     *              'group_level'=>int
     *              'group'=>string 'true - false'
     *              'reduce'=>string ' true-false-none'
     *              'stale'=>string 'ok - false-ubdate'
     *              'descending'=>string 'true - false'
     *
     * ]
     *
     *
     * @param string $viewDocName
     * @param type $viewName
     * @param type $arrayQuery
     * @return int
     */
    private function initQuery($q) {
        if (is_null($q)) return [];
        foreach ($q as $k => &$v) {
            if (in_array($k, array("key", "keys", "startkey", "endkey"))) $v = stripslashes(json_encode($v, JSON_UNESCAPED_UNICODE));
        }
//        dd('ss', $q);
        return $q;
    }

    public function CB_query($viewDocName, $viewName, $arrayQuery = NULL) {
//        dd('d', $arrayQuery, $this->initQuery($arrayQuery));
        $this->viewDocName = (env("CB_ENVIRONMENT") != 'Production') ? 'dev_' . $viewDocName : $viewDocName;

        $Docs = (object) ["rows" => [], "total_rows" => 0];


        try {
            $Docs->total_rows = $this->count($viewName, $this->initQuery($arrayQuery));
            $Docs->rows = $this->result($viewName, $this->initQuery($arrayQuery));
//            dd($Docs->rows);
            return $Docs;
        } catch (\CouchbaseException $exc) {
            ExeptionHandler::jsExiptionViewer($exc->getMessage());
            return $Docs;
        }
    }

    private function count($viewName, $arrayQuery) {
        return 56;
    }

    private function result($viewName, $arrayQuery) {
        $query = \CouchbaseViewQuery::from($this->viewDocName, $viewName)->custom($arrayQuery);
//        dd($query, $this->connect()->query($query, null, true)['rows']);
        return (object) $this->connect()->query($query, null, true)['rows'];
    }

}
