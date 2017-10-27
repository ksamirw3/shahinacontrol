<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Amit\CB;

/**
 * Description of View
 *
 * @author jooaziz
 */
class Row {

    public $id;
    public $key;
    public $value;

    public function __construct($row) {
        $row = (array) $row;
        $this->id = $row['id'];
        $this->key = $row['key'];
        $this->value = $row['value'];
    }

    public function getDoc() {
        return DocumentReader::get($this->id);
    }

}
