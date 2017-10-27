<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Amit\HTML\Components;

/**
 * Description of Image
 *
 * @author jooaziz
 */
class Label extends ElementsParent {

    private $innerText = '';

    public function __construct($text) {
        $this->innerText = $text;
    }

    public function get() {
        return "<label {$this->getElementBody()}>$this->innerText</label>";
    }

    public function forId($id) {
        return $this->addAttr('for', $id);
    }

    public function hasMutibleLang() {
        return $this;
    }

}
