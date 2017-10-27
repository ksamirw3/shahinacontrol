<?php

namespace App\Http\Mails\Api;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AuthMailer
 *
 * @author jooaziz
 */
use Mail;

class AuthMailer {

    public static function register($user) {
        return Mail::send('emails.users.confirm', ['row' => $user], function ($mail) use ($user) {
                    $mail->from(env('MAIL_FROM_EMAIL'), env('MAIL_FROM_NAME'));
                    $mail->to($user->email, $user->name)->subject(trans("admin.Confirm your account at") . env('SITE_NAME'));
                });
    }

}
