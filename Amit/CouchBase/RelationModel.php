<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Amit\CouchBase;

/**
 * Description of RelationModel
 *
 * @author jooaziz
 */
class RelationModel {

    private static $data;
    private static $relation;
    private static $ids;

    public static function makeRelation($data, $relation) {
        self::$data = $data;
        self::$relation = $relation;

        return self::genration();
    }

    private static function genration() {
        self::makeIds(self::$relation);
        $data = self::read(self::$ids);
        $rt = self::reformat($data);

        return $rt;
    }

    private static function makeIds($attr = null, $r = true) {
//        dd($attr);
        foreach ($attr as $relationAttr) {
            $value = ($r) ? self::$data->$relationAttr : $relationAttr;
            if (is_string($value)) {
                self::$ids[] = $value;
            } else {
                self::makeIds($value, FALSE);
            }
        }
    }

    private static function read($ids) {
        $reader = new Read();
        return $reader->get($ids);
    }

    private static function reformat($data) {
        $rt = [];
        foreach ($data as $row) {
            if (@$row->type) {
                $rt[$row->type][$row->id] = $row;
            }
        }
        return (object) $rt;
    }

}
