<?php

namespace Amit\CouchBase;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Document
 *
 * @author jooaziz
 */
class Document {

    public function __construct(array $attrs = []) {
        foreach ($this as $key => $val) {
            $this->$key = $attrs[$key];
        }
    }

    public function save() {

    }

    public function update() {

    }

    public function delete() {

    }

    public function remove() {

    }

}
