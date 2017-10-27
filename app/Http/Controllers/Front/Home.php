<?php

namespace App\Http\Controllers\Front;

class Home extends Base {

    public function __construct() {
        parent::__construct();
        $this->module = 'home';
    }

    public function getIndex() {
        return parent::view(['d']);
    }

}
