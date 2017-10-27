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
class BranchesValidator extends \App\Http\Validations\BaseValidation {

    protected $myUrl = 'admin/branches/';

    protected function validatCreate() {
        return[
            'name' => 'required|non_special|unique:branches,name',
            'manager_id' => 'required'
        ];
    }

    protected function validatEdit() {
        return[
            'name' => 'required|non_special|unique:branches,name,' . $this->get('id'),
            'manager_id' => 'required',
        ];
    }

//put your code here
}
