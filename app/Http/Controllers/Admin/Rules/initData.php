<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Admin\Rules;

/**
 * Description of initData
 *
 * @author jooaziz
 */
use App\Models\PermissionsRules;

class initData {

    public static function create(\Illuminate\Http\Request $request) {

        return$request->only('name');
    }

    public static function edit(\Illuminate\Http\Request $request) {
        return$request->only('name', 'id');
    }

    public static function createPermissions($row, \Illuminate\Http\Request $request) {
        $rt = [];
        foreach ($request->except('_token', 'name') as $k => $per)
            $rt[] = [
                'rule_id' => $row->id,
                'permission_id' => $k,
                'active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        return $rt;
    }

    public static function updatePermissions($row, \Illuminate\Http\Request $request) {
        PermissionsRules::whereRuleId($row->id)->update(['active' => 0]);
        $per = $request->except('name', '_token', 'id');
        foreach ($per as $k => $v) {
            $data = PermissionsRules::whereRuleId($row->id)->wherePermissionId($k)->first();
            if (is_null($data))
                $data = new PermissionsRules(['rule_id' => $row->id, 'permission_id' => $k]);
            $data->active = 1;
            $data->save();
        }
    }

}
