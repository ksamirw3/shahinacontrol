<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Amit\CouchBase;

/**
 * Description of Write
 *
 * @author PHP_Developer
 */
class Write {

    private $lastId;
    public $docType;
    public $prefix;
    private $reader;

    private function connect() {
        $this->reader = new Read();
        return CouchbaseConnect::connect();
    }

    public function create($data = [], $id = null) {
        if (is_null($this->connect())) return false;
        try {
            $this->lastId = (!is_null($id)) ? $id : $this->prefix . $this->keyGenrator();
            $t = time();
            $data['type'] = $this->docType;
            $data['created_at'] = $t;
            $data['updated_at'] = $t;
            $res = $this->connect()->insert($this->lastId, json_decode(json_encode($data, JSON_NUMERIC_CHECK)));
//            dd($res);
//            if ($res->error) ExeptionHandler::jsExiptionViewer(json_encode($res->error));
//            if (is_null($res->error))
            return $this->lastId;
//            return false;
        } catch (\CouchbaseException $exc) {
            ExeptionHandler::jsExiptionViewer($exc->getMessage());
            return false;
        }
    }

    public function update($id, $data = []) {
//        dd($id, $data);
        if (is_null($this->connect())) return false;
        try {
            $old = $this->reader->get($id);
            if (is_null($old)) return false;
            $old = (array) $old;
//            dd($old);
            foreach ($data as $k => $v) {
                $old[$k] = $v;
            }
            $old['updated_at'] = time();
            $res = $this->connect()->upsert($id, json_decode(json_encode($old, JSON_NUMERIC_CHECK)));
            if (is_null($res->error)) return true;
            return false;
        } catch (\CouchbaseException $exc) {
            ExeptionHandler::jsExiptionViewer($exc->getMessage());
            return false;
        }
    }

    public function remove($id) {
        try {
            $res = $this->connect()->remove($id);
            return true;
        } catch (\CouchbaseException $exc) {
            ExeptionHandler::jsExiptionViewer($exc->getMessage());
            return false;
        }
    }

    private function keyGenrator() {
        return md5(uniqid(time()));
    }

    public function counter($counterName, $value, $start_value = 1) {
        $result = $this->connect()->counter($counterName, $value, array('initial' => $start_value));
        return $result->value;
    }

}
