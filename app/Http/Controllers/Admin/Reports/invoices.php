<?php

namespace App\Http\Controllers\Admin\Invoices;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Groupes
 *
 * @author jooaziz
 */
use Amit\Support\Str;
use App\Http\Controllers\Admin\Base;
use App\Models\User as Model;
use App\Http\Validations\Admin\DreiversValidatio as check;

class Invoices extends Base {

    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
        parent::__construct();
    }

    public function getIndex() 
    {
        return parent::view();
    }
}
