<?php

namespace App\CustomeValidations;

use Illuminate\Http\Request;

class Area extends Base {

    protected $model;

    public function __construct(\App\Models\Area $model, Request $req) {
        parent::__construct();
        $this->validate($req,
                [
            'name_arabic' => 'required',
            'name_english' => 'required'
        ]);
    }

}
