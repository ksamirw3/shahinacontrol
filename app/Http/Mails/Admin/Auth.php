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
class Auth {

    public static function forgetPassword($row, $new_password) {
        return Mail::send('emails.admins.password',
                [ 'row' => $row, 'password' => $new_password],
                function( $mail) use($row) {
                $mail->from(env('MAIL_FROM_EMAIL'), env('MAIL_FROM_NAME'));
                $mail->to($row->email, @$row->name)->subject(__("admin.Your new password at") . ' ' . env('SITE_NAME'));
            });
    }
}