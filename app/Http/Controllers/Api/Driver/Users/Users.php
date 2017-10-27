<?php

namespace App\Http\Controllers\Api\Driver\Users;

use Hash;
use Mail;
use JooAziz\Response\Response;
use App\Models\Driver as Model;
use App\Http\Controllers\Api\Driver\Users\Validator as Checker;

class Users extends \App\Http\Controllers\Api\Base
{

    public function anyLogin(Checker $d)
    {

        $user = request()->username;
        $password = request()->password;
        $row = @Model::wherePhone($user)->first();
        if (!$row) {
            return Response::make()->setMessage(__('admin.driver not found'))->send();
        }
        if (!$row->active == 1) {
            return Response::make()->setMessage(__('admin.sorry your account is not active please contact with admin'))->send();
        }
        if (\Hash::check($password, $row->password)) {
            $row->is_busy = 0;
            $row->is_connect = 1;
            $row->save();
            return Response::make()->setResult(TRUE)->setData(['id' => (int)$row->id, 'full_name' => $row->full_name, 'presonal_image' => $row->presonal_image])->setMessage(__('admin.driver found'))->send();
        } else {
            return Response::make()->setMessage(__('admin.wrong username or password'))->send();
        }
    }

    public function getById($id)
    {
        if (!$id)


            return Response::make()->setMessage(__('admin.undifaind id for method'))->send();
        $row = Model::find($id);
        if (!$row)
            return Response::make()->setMessage(__('admin.user not found '))->send();

        unset($row->password);
        return Response::make()->setData($row)->send();
    }

    public function anyLogout(Checker $d)
    {

        $row = @Model::find(request()->id);
        if (!$row) {
            return Response::make()->setResult(false)->setMessage(__('admin.driver not found'))->send();
        }

        $row->is_connect = 0;
        $row->save();
        return Response::make()->setResult(true)->setMessage(__('admin.driver logout successfully'))->send();
    }

    public function anyUpdateKey(Checker $d)
    {
        //return 'aaaaaa';
        $row = @Model::find(request()->id);
        if (!$row) {
            return Response::make()->setMessage(__('admin.driver not found'))->send();
        }
        $row->token = request()->token;
        $row->token_type = 'android';
        $row->save();
        return Response::make()->setResult(TRUE)->setMessage(__('admin.token update successfully'))->send();
    }

    public function anyUpdateToken(Checker $d)
    {
        $row = @Model::find(request()->id);
        if (!$row) {
            return Response::make()->setMessage(__('admin.driver not found'))->send();
        }
        $row->token = request()->token;
        $row->token_type = 'ios';
        $row->save();
        return Response::make()->setResult(TRUE)->setMessage(__('admin.token update successfully'))->send();
    }

    public function anyResetPassword(Checker $d)
    {
        $row = @Model::find(request()->id);
        if (!$row) {
            return Response::make()->setMessage(__('admin.driver not found'))->send();
        }

        if (Hash::check(request()->get('password'), $row->password)) {
            $row->password = Hash::make(request()->new_password);
            $row->save();
            return Response::make()->setResult(TRUE)->setMessage(__('admin.password reset successfully'))->send();
        } else {
            return Response::make()->setMessage(__('admin.password not correct'))->send();
        }
    }

    public function anyForgetPassword(Checker $d)
    {

        $row = @Model::whereEmail(request()->email)->first();
        if (!$row) {
            return Response::make()->setMessage(__('admin.driver not found'))->send();
        }
        $newPass = \Amit\Support\Str::random(10);
        $row->password = Hash::make($newPass);
        $row->save();
        Mail::send('emails.client.forget', ['row' => $row, 'newPass' => $newPass], function ($mail) use ($row) {
            $mail->from(env('MAIL_FROM_EMAIL'), env('MAIL_FROM_NAME'));
            $mail->to($row->email, $row->username)->subject(__("api.Your new password at") . ' ' . env('SITE_NAME'));
        });
        return Response::make()->setResult(TRUE)->setMessage(__('admin.password reset and sent to your email successfully'))->send();
    }

    public function anyViewProfile(Checker $d)
    {
        $row = @Model::find(request()->id);
        if (!$row) {
            return Response::make()->setMessage(__('admin.driver not found'))->send();
        }
        if (request()->get('id')) {
            return Response::make()->setData($row)->setResult(TRUE)->setMessage(__('admin.driver  found'))->send();
        } else {
            return Response::make()->setMessage('profile not found')->send();
        }
    }

    public function anyUpdateStatus(Checker $d)
    {
        $row = @Model::find(request()->id);
        if (!$row) {
            return Response::make()->setMessage(__('admin.driver not found'))->send();
        }

        if (request()->get('status') == 1) {
            $row->is_connect = 1;
            if ($row->save()) {
                $result = true;
                $error = "";
            } else {
                $result = false;
                $error = "can not save user status";
            }
            return Response::make()
                ->setResult($result)
                ->setError($error)
                ->setMessage(__('admin.driver is online'))->send();
        } elseif (request()->get('status') == 0) {
            $row->is_connect = 0;
            $row->is_busy = 0;
            if ($row->save()) {
                $result = true;
                $error = "";
            } else {
                $result = false;
                $error = "can not save user status";
            }
            return Response::make()->setResult($result)
                ->setError($error)
                ->setMessage(__('admin.driver is offline'))->send();
        }
    }

    public function anyUpdateLocation(Checker $d)
    {
        $row = @Model::find(request()->id);
        if (!$row) {
            return Response::make()->setMessage(__('admin.driver not found'))->send();
        }
        $row->longitude = request()->longitude;
        $row->latitude = request()->latitude;
        if ($row->save()) {
            $result = true;
            $error = "";
        } else {
            $result = false;
            $error = "can not update user status";
        }
        return Response::make()->setResult($result)
            ->setError($error)
            ->setMessage(__('admin.location updated successfully'))
            ->send();
    }

}
