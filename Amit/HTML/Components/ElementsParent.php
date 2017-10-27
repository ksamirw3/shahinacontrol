<?php

namespace Amit\HTML\Components;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ElementsParent
 *
 * @author jooaziz
 */
abstract class ElementsParent implements InterfaceElements {

    protected $classes = [];
    protected $atters = [];

    public function addAttr($attr, $value) {
        $this->atters[] = [$attr, $value];
        return $this;
    }

    public function addClass($class) {
        $this->classes[] = $class;
        return $this;
    }

    protected function getElementBody() {
        return Helper::parseClass($this->classes) . Helper::parseAttres($this->atters);
    }

    abstract public function get();
}
