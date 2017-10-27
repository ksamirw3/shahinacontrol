<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

class Configs extends Base {

    public $model;
    public $module = 'configs';
    public $rules;

    public function __construct(\App\Models\Elquent\Config $model) {
        parent::__construct();
        $this->model = $model;
    }

    public function getTermes() {
        return view($this->viewPerfix('terms'), ['data' => $this->model->getTermes()]);
    }

}
