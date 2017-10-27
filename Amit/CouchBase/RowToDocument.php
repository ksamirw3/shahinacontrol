<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RowToDocument
 *
 * @author jooaziz
 */
class RowToDocument {

    public $id;
    public $key;
    public $value;

    public function __construct($row) {
        $this->id = $row->id;
        $this->key = $row->key;
        $this->value = $row->value;
    }

    public function getDoc() {
        return ( new \Amit\CouchBase\Read())->get($this->id);
    }

}
