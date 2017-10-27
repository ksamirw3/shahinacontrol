<?php

namespace App\Http\Mails\Admin;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Mail;

/**
 * Description of Auth
 *
 * @author jooaziz
 */
class Driver {

    public static function newPass(\App\Models\Driver $driver) {
        return Mail::send('emails.driver.newPass', ['driver' => $driver], function ($mail) use ($driver) {
                    $mail->from(env('MAIL_FROM_EMAIL'), env('MAIL_FROM_NAME'));
                    $mail->to($driver->email, $driver->username)->subject(__("admin.new password") . env('SITE_NAME'));
                });
    }

}
