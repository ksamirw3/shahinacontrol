<?php

namespace Amit\HTML\Components;

interface InterfaceElements {

    public function get();

    public function addClass($class);

    public function addAttr($attr, $value);
}
