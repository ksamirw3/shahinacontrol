<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Admin\Permissions;

/**
 * Description of initData
 *
 * @author jooaziz
 */
class initData {

    public static function create(\Illuminate\Http\Request $request) {
        return $request->except('_token');
    }

    public static function getActions() {
        return [
            'view' => 'view',
            'add' => 'add',
            'edit' => 'edit',
            'delete' => 'delete',
        ];
    }

    public static function getModels() {
        return [
            'admins' => 'admins',
            'rules' => 'rules',
            'permissions' => 'permissions',
            'groups' => 'groups',
            'branches' => 'branches',
            'labs' => 'labs',
            'diplomas' => 'diplomas',
            'students' => 'students',
            'studentsgroups' => 'studentsgroups',
            'instructors' => 'instructors',
            'courses' => 'courses',
        ];
    }

}
