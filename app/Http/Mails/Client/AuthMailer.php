<?php

namespace App\Http\Mails\Client;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Auth
 *
 * @author jooaziz
 */
class AuthMailer {

    public static function sendRegisterMail($data) {
        return \Mail::send('emails.client.confirm', ['row' => $data], function ($mail) use ($data) {
                    $mail->from(env('MAIL_FROM_EMAIL'), env('MAIL_FROM_NAME'));
                    $mail->to($data['email'], $data['name'])->subject(__("account.Confirm your account at") . ' ' . env('SITE_NAME'));
                });
    }

}
