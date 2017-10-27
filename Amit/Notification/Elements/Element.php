<?php

namespace Amit\Notification\Elements;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Element
 *
 * @author jooaziz
 */
abstract class Element {

    protected $class;
    protected $type;
    protected $toggle;
    protected $target;
    protected $text;
    protected $id;

    abstract function render();

    public function setClass($class) {
        $this->class = $class;
        return $this;
    }

    public function setText($text) {
        $this->text = $text;
        return $this;
    }

    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    public function setDataToggle($toggle) {
        $this->toggle = $toggle;
        return $this;
    }

    public function setDataTarget($target) {
        $this->target = $target;
        return $this;
    }

    public function getTarget() {
        return $this->target;
    }

    public function getToggle() {
        return $this->toggle;
    }

    public function getType() {
        return $this->type;
    }

    public function getClass() {
        return $this->class;
    }

    public function getText() {
        return $this->text;
    }

}
