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
class StudentsGroupsValidator extends \App\Http\Validations\BaseValidation {

    protected $myUrl = 'admin/studentsgroups/';

    protected function validatCreate() {
        $data = StudentsValidator::getRules();
        $data['group_id'] = 'required';
        $data['mobile'] = 'required|digits_between:4,14';
        return $data;
    }

    protected function validatEdit() {
//        dd($this->all());
        $data = StudentsValidator::getRules();
        $data['mobile'] = 'required|digits_between:4,14|unique:students,mobile,' . $this->get('student_id');
        $data['group_id'] = 'required';
        $data['student_id'] = 'required';
        return $data;
    }

}
