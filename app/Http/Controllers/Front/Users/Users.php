<?php

namespace App\Http\Controllers\Front\Users;

use \App\Models\User;

class Users extends \App\Http\Controllers\Front\Base {

    public function getActive() {
        if (request()->t) {
            $row = User::whereActiveToken(request()->t)->first();
            if (!$row)
                return 'invalid token or unregisterd user';


            $row->active = 1;
            $row->active_token = null;
            $row->save();
            return 'thanks for active please login';
        } else {
            return 'invalid token or unregisterd user';
        }
    }

}
