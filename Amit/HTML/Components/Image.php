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
class Image extends ElementsParent {

    public function __construct($src) {
        $this->addAttr('src', $src);
    }

    public function get() {
        return "<img " . $this->getElementBody() . " />";
    }

}
