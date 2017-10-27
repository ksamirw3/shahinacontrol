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
class CoursesValidator extends \App\Http\Validations\BaseValidation {

    protected $myUrl = 'admin/courses/';

    protected function validatCreate() {

        return[
            'name' => 'required|non_special|unique:courses,name,NULL,id,deleted_at,NULL',
            'total_hours' => 'required',
            'diploma_id' => 'required',
        ];
    }

    protected function validatEdit() {
        /**
         * select count(*) as aggregate from `courses` where `name` = Javascript and `id` = 5 and `deleted_at` is null
          'name' => 'required|unique:courses,name,NULL,id,id,' . $this->get('id') . ',deleted_at,NULL,d,NULL'
         *
         * select count(*) as aggregate from `courses` where `name` = Javascript and `id` <> 5 and `deleted_at` is null
          'name' => 'required|unique:courses,name,' . $this->get('id') . ',id,deleted_at,NULL,d,NULL',
         */
//        return[
//            'name' => 'required|unique:courses,name,id,' . $this->get('id') . ',diploma_id,'.$this->get('diploma_id').',deleted_at,NULL',
//            'total_hours' => 'required',
//            'diploma_id' => 'required|exists:course_diploma,diploma_id,course_id,!'.$this->get('id').',deleted_at,NULL',
//        ];
        return[
            'name' => 'required|non_special|unique:courses,name,' . $this->get('id') . ',id,deleted_at,NULL',
            'total_hours' => 'required',
            'diploma_id' => 'required',
        ];
    }
}