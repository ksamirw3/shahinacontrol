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
class SessionsValidator extends \App\Http\Validations\BaseValidation {

    protected $myUrl = 'admin/sessions/';

    protected function validatCreate() {
        return [
            "date" => "required",
            "start_time" => "required",
            "end_time" => "required",
            "instructor_id" => "required",
            "lab_id" => "required",
            "group_id" => "required",
            "course_id" => "required"
        ];
    }

    protected function validatEdit() {
        return['name' => 'required|non_special|unique:labs,name,' . $this->get('id'), 'branch_id' => 'required'];
    }

//put your code here
}
