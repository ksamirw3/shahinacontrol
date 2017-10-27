<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Validations\Admin;

/**
 * Description of GroupesValidator
 *
 * @author jooaziz
 */
class RulesValidator extends \App\Http\Validations\BaseValidation {

    protected $myUrl = 'admin/rules/';

    protected function validatCreate() {
        return['name' => 'required|non_special|unique:rules,name'];
    }

    protected function validatEdit() {
        return['name' => 'required|non_special|unique:rules,name,' . $this->get('id')];
    }

//put your code here
}
