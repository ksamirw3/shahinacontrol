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
class DiplomasValidator extends \App\Http\Validations\BaseValidation {

    protected $myUrl = 'admin/diplomas/';

    protected function validatCreate() {
        return['name' => 'required|non_special|unique:diplomas,name,NULL,id,deleted_at,NULL'];
    }

    protected function validatEdit() {
        return['name' => 'required|non_special|unique:diplomas,name,' . $this->get('id') . ',id,deleted_at,NULL'];
    }

}
