<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Amit\CB;

/**
 * Description of Helper
 *
 * @author jooaziz
 */
class Helper {

    public static function reformatResult($res, $id) {
        if (is_array($res)) {
            $rt = self::reformatForBulkResult($res);
        } else {
            $rt = self::reformatForSingelResult($res);
            $rt->id = $id;
        }
        return $rt;
    }

    protected static function reformatForBulkResult($arr) {
        $rt = [];
        foreach ($arr as $k => $v) {
            if (!is_null($v->error)) {
                ExeptionHandler::jsExiptionViewer($v->error->getMessage() . " in id : " . $k);
                continue;
            }

            $rt[$k] = self::reformatForSingelResult($v);
            $rt[$k]->id = $k;
        }
        return $rt;
    }

    protected static function reformatForSingelResult($res) {

        return self::makeToObject(self::stringValueToOpject($res->value));
    }

    public static function stringValueToOpject($val) {
        if (is_string($val)) $val = json_decode($val);
        return $val;
    }

    private static function makeToObject($val) {
        if (@$val->type && $val->type != '') {
            $class = '\\App\Models\\' . \Amit\Support\Str::ClassCase($val->type);
            if (class_exists($class)) return (new $class((array) $val));
            else return new Undefined((array) $val);
        } else {
            return new Undefined((array) $val);
        }
    }

    public static function addDates() {
        $t = date('Y-m-d H:i:s', time());
        return ['created_at' => $t, 'updated_at' => $t];
    }

    public static function rowAsModel($rows = []) {
        $newRows = [];
        foreach ($rows as $row) $newRows[] = new Row($row);
        return $newRows;
    }

}
