<?php

namespace App\Http\Controllers\Admin\Settings;

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
use App\Http\Validations\Admin\DreiversValidatio as check;
use App\Models\Setting as Model;


class Settings extends \App\Http\Controllers\Admin\Base {

    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
        parent::__construct();
    }

    public function getIndex() 
    {
        $forms = Model::all();
        return parent::view(compact('forms'));
    }

    public function postCreate(check $d)
    {

        foreach(request()->except('_token') as $k=> $field)
        {
           $row =  Model::whereName($k)->first();

           $row->value = $field;
           $row->save();
       }

       return parent::redirectToIndex();
   }
}
