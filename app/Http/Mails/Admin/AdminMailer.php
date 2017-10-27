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
class AdminMailer {

    public static function createAdminConfirmation($data, $request) {
        return Mail::send('emails.admins.confirm', ['row' => (object) $data],
                function ($mail) use ($request) {
                $mail->from(env('MAIL_FROM_EMAIL'), env('MAIL_FROM_NAME'));
                $mail->to($request->input('email'), $request->input('username'))->subject(__("admin.Confirm your account at") . env('SITE_NAME'));
            });
    }
}