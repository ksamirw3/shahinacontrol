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
 * @author Suzy William
 */
class CoursesInstructorsValidator extends \App\Http\Validations\BaseValidation {

    protected $myUrl = 'admin/coursesinstructors/';

    protected function validatCreate() {
        $data = InstructorsValidator::getRules();
        $data['course_id'] = 'required';
        $data['rate'] = 'required|numeric|min:0';
        return $data;
    }

    protected function validatEdit() {
        return ['course_id' => 'required', 'instructor_id' => 'required', 'rate' => 'required|numeric|min:0'];
    }
}