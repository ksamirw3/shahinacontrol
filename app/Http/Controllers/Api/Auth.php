<?php
/*
 * 200 :success
 * 401: unauthorized
 * 404: page not found
 * 403: validation error
 * error codes:
  2100 : required/format fields fields needed
  2101 : User exist with this username
  2102:  User exist with this email
  2103 : Invalid username
  2104 : Invalid password
  2105 : User not activated
  2106 : Account with this email is not exist
  2107 : Account with this username is not exist
  2108 : Invalid old password
  2109 : User exist with this telephone
  2110 : empty cart
  2112 : invalid username or email
  2113 : invalid username formate
 */

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Mail;
use Validator;
use Hash;
use App\Libs\Misc;

class Auth extends Base {

    public $model;
    public $module;

    public function __construct(\App\Models\User $model) {
        $this->module = 'users';
        $this->model = $model;
    }
    /*
     * sign up (done)
     */

    public function postRegister(Request $request) {
//*** name, username, email, password ***//

        $inputs = $request->all();
        /**
         * check required fields
         */
        $require_validator = Validator::make($inputs,
                [
                'username' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8',
                'name' => 'required',
                'phone' => 'digits_between:4,12',
        ]);
        if ($require_validator->fails()) {
            return response()->json(['message' => $require_validator->errors(), 'code' => '2100'],
                    403);
        }

        /**
         * check username format
         */
        $username_validator_format = Validator::make($inputs,
                [
                'username' => 'required|regex:/^[A-Za-z0-9@-_.]+$/',
        ]);
        if ($username_validator_format->fails()) {
            return response()->json(['message' => $username_validator_format->errors(),
                    'code' => '2113'], 403);
        }
        /**
         * check username existance
         */
        $row = array_values($this->model->getByUsername(strtolower(trim($request->get('username')))));
        if (@$row[0]) {
            return response()->json(['message' => __("api.User exist with this userrname"),
                    'code' => '2101'], 403);
        }
        /**
         * check email existance
         */
        $row = array_values($this->model->getByEmail(strtolower(trim($request->get('email')))));
        if (@$row[0]) {
            return response()->json(['message' => __("api.User exist with this email"),
                    'code' => '2102'], 403);
        }
        /**
         * fill data
         */
        $postedData = $request->only(['email', 'password', 'username']);
        $postedData['password'] = Hash::make($postedData['password']);
        $postedData['confirm_token'] = md5(rand(1000000, 999999999)) . md5($postedData['username']) . md5(time());
        $postedData['token'] = md5(rand(1000000, 999999999)) . md5($postedData['username']) . md5(time());
        $postedData['activated'] = 0;
        $postedData['name'] = $request->input('name');
        $postedData['gender'] = (!empty($request->input('gender'))) ? $request->input('gender')
                : 'o';
        $country = (!empty($request->input('country'))) ? $request->input('country')
                : "AE";
        $postedData['wishlist'] = [];
        $postedData['country'] = $country;
        $postedData['selected_country'] = array($country);
        $this->model->create($postedData);
        if ($key = $this->model->save()->id) {
            $userChannel = "userData" . strtolower(str_replace('-', '',
                        str_replace('user::', '', $key)));
            $this->model->sync_gateway['all_channels'] = array("public", $userChannel,
                $country);
            $this->model->sync_gateway['username'] = str_replace("user::", "",
                $key);
            $this->model->sync_gateway['password'] = str_replace("user::", "",
                $key);
            $this->model->owner = str_replace("user::", "", $key);
            if ($this->model->update()) {
                /*
                 * create user events(perCountry)
                 */
                (new \App\Models\UserEvent())->create(
                    ['user_id' => $key, 'country' => $country,
                    'username' => $postedData['username'],
                    'owner' => str_replace("user::", "", $key)],
                    'user_event' . '::' . $country . '::' . $key)->save();
                /*
                 * create user notification
                 */
                (new \App\Models\UserNotification())->create(
                    ['user_id' => $key, 'username' => $postedData['username'],
                    'owner' => str_replace("user::", "", $key)],
                    'user_notification::' . $key)->save();

                /*
                 *  insert into sync gatway
                 */
                $rs = Misc::create_user_syngatway($key,
                        str_replace("user::", "", $key),
                        str_replace("user::", "", $key));
                /*
                 * send confirm email
                 */


                /**
                 * creat sql user
                 */
                \App\Models\Elquent\User::create([
                    'username' => $postedData['username'],
                    'email' => $postedData['email'],
                    'gender' => 'o',
                    'couch_id' => $key
                ]);
                Mail::send('emails.users.confirm',
                    ['row' => (object) $postedData],
                    function ($mail) use ($request) {
                    $mail->from(env('MAIL_FROM_EMAIL'), env('MAIL_FROM_NAME'));
                    $mail->to($request->input('email'), $request->input('name'))->subject(__("api.Confirm your account at") . env('SITE_NAME'));
                });
                return response()->json(['message' => __("api.Registeration successfull, please check your email to confirm your account")],
                        200);
            }
        }
    }
    /*
     * login (done)
     */

    public function postLogin(Request $request) {
//*** Inputs:username, password ***//
        $validator = Validator::make($request->all(),
                [
                'parameter' => 'required',
                'password' => 'required|min:8',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors(), 'code' => '2100'],
                    403);
        }
//*** get user document contain username or email ***//
        if (filter_var($request->input('parameter'), FILTER_VALIDATE_EMAIL)) {
            $row = array_values($this->model->getByEmail(strtolower(trim($request->input('parameter')))));
        }
        else {
            $username = strtolower(trim(preg_replace('/[^\w\s.@-_^]+/u', '',
                        $request->input('parameter'))));
//            dd($username);
            $row = array_values($this->model->getByUsername($username));
        }

        if (!$row) {
            return response()->json(['message' => __('api.Invalid username or email'),
                    'code' => '2112'], 403);
        }
        $row = @$row[0];
//*** end ***//
        if (!Hash::check($request->input('password'), @$row->password)) {
            return response()->json(['message' => __('api.Invalid password'),
                    'code' => '2104'], 403);
        }
        if (!@$row->activated) {
            return response()->json(['message' => __('api.This user is not confirmed, please go to your email to confirm your account'),
                    'code' => '2105'], 403);
        }
        return response()->json(['user' => $row], 200);
    }
    /*
     * forget password (done)
     */

    public function postForgotPassword(Request $request) {
//*** Inputs:email ***//
        $validator = Validator::make($request->all(),
                [
                'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors(), 'code' => '2100'],
                    403);
        }
//*** get user document contain email ***//
        $row = array_values($this->model->getByEmail(trim(strtolower($request->input('email')))));
        if (!$row) {
            return response()->json(['message' => __('api.Account with this email is not exist'),
                    'code' => '2106'], 403);
        }
        $row = @$row[0];
//*** end ***//
//*** genereate new password and save it then send it to email***//
        $new_password = str_random(8);

//////////////////////////////////////send confirm email
        $send = Mail::send('emails.users.password',
                ['row' => $row, 'password' => $new_password],
                function ($mail) use ($row) {
                $mail->from(env('MAIL_FROM_EMAIL'), env('MAIL_FROM_NAME'));
                $mail->to($row->email, $row->username)->subject(__("api.Your new password at") . ' ' . env('SITE_NAME'));
            });
        if ($send) {
            //$postedData['password'] = Hash::make($new_password);
            $row->password = Hash::make($new_password);
            $row->update();
            return response()->json(['message' => __("api.Message has been sent to your email with the new password")],
                    200);
//////////////////////////////////////////// update document with the new password
        }
    }
    /*
     * resend activation (done)
     */

    public function postResendActivation(Request $request) {
//*** Inputs:email ***//
        $validator = Validator::make($request->all(),
                [
                'parameter' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors(), 'code' => '2100'],
                    403);
        }
//*** get user document contain username ***//
        if (filter_var($request->input('parameter'), FILTER_VALIDATE_EMAIL)) {
            $row = array_values($this->model->getByEmail(trim(strtolower($request->input('parameter')))));
        }
        else {
            $username = preg_replace('/[^\w\s.@-]+/u', '',
                $request->input('parameter'));
            $row = array_values($this->model->getByUsername(trim(strtolower($username))));
        }
        if (!$row) {
            return response()->json(['message' => __('api.Account with this username/email is not exist'),
                    'code' => '2107'], 403);
        }
        $row = @$row[0];
        if ($row->activated == 0) {

            //////////////////////////////////////send confirm email
            $send = Mail::send('emails.users.confirm', ['row' => $row],
                    function ($mail) use ($row) {
                    $mail->from(env('MAIL_FROM_EMAIL'), env('MAIL_FROM_NAME'));

                    $mail->to($row->email, $row->username)->subject(__("admin.Confirm your account at") . env('SITE_NAME'));
                });
            if ($send) {
                return response()->json(['message' => __('api.Confirmation link has been sent to your account, please check your email to confirm your account')],
                        200);
                //////////////////////////////////////////// update document with the new password
            }
        }
    }
    /*
     * change password(done)
     */

    public function postChangePassword(Request $request) {
        //*** token, password ***//
        $row = array_values($this->model->getByToken($request->input('token')));
        if (!$row) {
            return response()->json(['message' => __("api.Invalid User token")],
                    401);
        }
        ///////////////////////////////
        $validator = Validator::make($request->all(),
                [
                'old_password' => 'required|min:8',
                'new_password' => 'required|min:8',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors(), 'code' => '2100'],
                    403);
        }
        $row = $row[0];
        if (!Hash::check($request->input('old_password'), @$row->password)) {
            return response()->json(['message' => __('api.Invalid old password'),
                    'code' => '2108'], 403);
        }
        $row->password = Hash::make($request->input('new_password'));
        if ($row->update()) {
            //////////////////////////////////////////
            return response()->json(['message' => __("api.Password has been changed")],
                    200);
        }
    }
    /*
     * register pushToken (done)
     */

    public function postRegisterPushToken(Request $request) {
        //*** token, password ***//
        $row = array_values($this->model->getByToken($request->input('token')));
        if (!$row) {
            return response()->json(['message' => __("api.Invalid User token")],
                    401);
        }
        ///////////////////////////////
        $validator = Validator::make($request->all(),
                [
                'push_token' => 'required|min:4',
                'type' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors(), 'code' => '2100'],
                    403);
        }
        $row = $row[0];
        $row->push_token = $request->input('push_token');
        $row->push_type = $request->input('type');
        if ($row->update()) {
            \App\Models\Elquent\User::whereCouchId($row->id)->
                update(['push_token' => $request->input('push_token'), 'push_type' => $request->input('type')]);
            //---------------------------
            return response()->json(['message' => __("api.Push token has been changed")],
                    200);
        }
    }
}