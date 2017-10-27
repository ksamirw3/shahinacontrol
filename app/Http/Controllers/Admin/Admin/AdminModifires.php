<?php

namespace App\Http\Controllers\Admin\Admin;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use App\Http\Authantications\AdminAuth;

class AdminModifires {

    public static function validateUpdateAdmin($row) {
        if ($row) {
            AdminAuth::update_user($row);
            $rt['status'] = 'success';
            $rt['message'] = __('admin.Admin has been edited successfully');
        } else {
            $rt['status'] = 'error';
            $rt['message'] = __('admin.Failed to save');
        }

        return (object) $rt;
    }

    public static function validatChangPassword($request, $row) {
        $rt = [];
        if (!\Hash::check($request->input('old_password'), @$row->password)) {
            $rt['status'] = "error";
            $rt['message'] = __('admin.Password entered not matched with Current Password');
        } else {
            $row->password = \Hash::make($request->input('password'));
            if ($row->update()) {
                $rt['status'] = "success";
                $rt['message'] = __('admin.Password Changed successfully');
            } else {
                $rt['status'] = "error";
                $rt['message'] = __('admin.can`t change password');
            }
        }
        return (object) $rt;
    }

}
