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
class LabsValidator extends \App\Http\Validations\BaseValidation {

    protected $myUrl = 'admin/labs/';

    protected function validatCreate() {
        return['name' => 'required|non_special|unique:labs,name', 'branch_id' => 'required'];
    }

    protected function validatEdit() {
        return['name' => 'required|non_special|unique:labs,name,' . $this->get('id'), 'branch_id' => 'required'];
    }

//put your code here
}
