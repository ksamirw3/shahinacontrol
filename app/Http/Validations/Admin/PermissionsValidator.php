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
class PermissionsValidator extends \App\Http\Validations\BaseValidation {

    protected $myUrl = 'admin/permissions/';

    protected function validatCreate() {

        return[
            'action' => 'required',
            'model' => 'required',
            'label' => 'required',
        ];
    }

    protected function validatEdit() {
        return[
            'action' => 'required',
            'model' => 'required',
            'label' => 'required',
        ];
    }

//put your code here
}
