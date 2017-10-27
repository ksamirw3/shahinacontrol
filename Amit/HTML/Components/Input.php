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
class Input extends ElementsParent {

    public function __construct($name, $val = '', $attrs = []) {
        $this->addAttr('name', $name);
        $this->addAttr('id', $name);
        $this->addAttr('placeholder', $name);
        $this->value($val);
        foreach ($attrs as $k => $v) {
            $this->addAttr($k, $v);
        }
    }

    public function get() {
        return "<input " . $this->getElementBody() . " />";
    }

    public function type($type) {
        return $this->addAttr('type', $type);
    }

    public function readonly() {
        return $this->addAttr('readonly', true);
    }

    public function required() {
        return $this->addAttr('required', true);
    }

    public function value($val) {
        return $this->addAttr('value', $val);
    }

}
