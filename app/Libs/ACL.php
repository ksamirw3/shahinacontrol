<?php

namespace App\Libs;

use App\Libs\Adminauth;
use Session;

class ACL {

    private static $allowed = ["dashboard"];

    static function can($action, $userId = NULL) {
        if (in_array($action, self::$allowed)) {
            return true;
        }
        $user = Adminauth::user();
        if (!$user) return redirect("admin/auth/login");
        if (@$user->super_admin) return true;
        $roles = Adminauth::roles();
        if (@in_array($action, $roles)) return true;
        return false;
    }

    static function cant($action, $user_id = NULL) {
        return !(self::can($action));
    }
}
?>
