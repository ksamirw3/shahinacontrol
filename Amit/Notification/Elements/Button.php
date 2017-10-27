<?php

namespace Amit\Notification\Elements;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Button
 *
 * @author jooaziz
 */
class Button extends Element {

    protected $class = "btn btn-primary";
    protected $type = "button";
    protected $toggle = "modal";
    protected $target = "#message";
    protected $text = 'button text';

    public function render() {
        $r = '';
        $r .= '<button type="' . $this->type .
                '" class="' . $this->class .
                '" data-toggle="' . $this->toggle .
                '" data-target="#' . $this->target . '" >';
        $r .= $this->text;
        $r .= '</button>';
    }

}
