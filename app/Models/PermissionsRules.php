<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

/**
 * Description of CourseInstructor
 *
 * @author Suzy William
 */
class PermissionsRules extends BaseModel {

    protected $table = 'permissions_rules';

    public function permissions() {
        return $this->belongsTo(Permission::class, 'permission_id');
    }

    public function rules() {
        return $this->belongsTo(Rule::class);
    }

}
