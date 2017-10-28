<?php

namespace App\Http\Controllers\Api\Client\Users;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Mail;
use Hash;
use App\Models\User as Model;
use JooAziz\Response\Response;
use App\Http\Controllers\Api\Base;
use App\Http\Controllers\Api\Client\Users\Validator as Checker;

class Users extends Base {

    public function getById($id = null) {
        if (!$id)
            return Response::make()->setMessage('undefined id for method')->send();
        $row = Model::find($id);
        if (!$row)
            return Response::make()->setMessage('user not found ')->send();
        unset($row->password);
        return Response::make()->setData($row)->send();
    }

    public function anyRegister(Checker $d) {
        $data = InitData::createData();
       
        $row = Model::quickSave($data);
        if (!$row)
            return Response::make()->setMessage('client not saved')->send();

        
//        replace with SMS validation
        
        
//        Mail::send('emails.users.active', ['row' => $row], function ($mail) use ($row) {
//            $mail->from(env('MAIL_FROM_EMAIL'), env('MAIL_FROM_NAME'));
//            $mail->to($row->email, $row->username)->subject(__("api.Your new password at") . ' ' . env('SITE_NAME'));
//        });


        return Response::make()->setData('')->setResult(TRUE)->setMessage(__('admin.please active you account'))->send();
    }

    public function anyLogin(Checker $d) {
        $phone = request()->phone;
        $password = request()->password;

        $row = @Model::wherePhone($phone)->first();
//dd($row);


        if (!$row) {
            return Response::make()->setMessage('user not found')->send();
        }

        if ($row->active != 1) {
            return Response::make()->setMessage(__('admin.sorry your account is not active please contact with admin'))->send();
        }

        if (\Hash::check($password, $row->password)) {
            $row->is_busy = 0;
            $row->is_connect = 1;
            $row->save();
            return Response::make()->setResult(TRUE)->setMessage('user found')->setData(["id" => $row->id])->send();
        } else {
            return Response::make()->setMessage(__('admin.wrong username or password'))->send();
        }
    }

    public function anyLogout(Checker $d) {
        
        $row = @Model::find(request()->id);
        if (!$row)
            return Response::make()->setMessage('user not found')->send();

        $row->is_connect = 0;
        $row->save();
        return Response::make()->setResult(TRUE)->setMessage(__('user.logout successfully'))->send();
    }

    public function anyUpdateLocation(Checker $d) {
        $row = @Model::find(request()->id);
        if (!$row)
            return Response::make()->setMessage('user not found')->send();


        $row->longitude = request()->longitude;
        $row->latitude = request()->latitude;
        $row->save();
        return Response::make()->setResult(TRUE)->setMessage("Location has been updated successfully")->send();
    }

    public function anyForgetPassword(Checker $d) {

        $row = @Model::whereEmail(request()->email)->first();
        if (!$row)
            return Response::make()->setMessage(__('admin.user not found'))->send();

        $newPass = \Amit\Support\Str::random(10);
        $row->password = Hash::make($newPass);
        $row->save();
        Mail::send('emails.client.forget', ['row' => $row, 'newPass' => $newPass], function ($mail) use ($row) {
            $mail->from(env('MAIL_FROM_EMAIL'), env('MAIL_FROM_NAME'));
            $mail->to($row->email, $row->username)->subject(__("api.Your new password at") . ' ' . env('SITE_NAME'));
        });
        return Response::make()->setResult(TRUE)->setMessage(__('admin.password reset and sent to your email successfully'))->send();
    }

    public function anyUpdateKey(Checker $d) {
        $row = @Model::find(request()->id);
        if (!$row)
            return Response::make()->setMessage('user not found')->send();
        InitData::updateToken($row, 'android');
        return Response::make()->setResult(TRUE)->setMessage(__('admin.token update successfully'))->send();
    }

    public function anyUpdateToken(Checker $d) {
        $row = @Model::find(request()->id);
        if (!$row)
            return Response::make()->setMessage('user not found')->send();
        InitData::updateToken($row, 'ios');
        return Response::make()->setResult(TRUE)->setMessage(__('admin.token update successfully'))->send();
    }
    
    
    public function postUpdateProfileImage(\Illuminate\Http\Request $request){
        
        $image = base64_decode($request->image);
        
        $row = @Model::find(request()->id);
        if (!$row){
            return Response::make()->setMessage(__('admin.user not found'))->send();
        }
        
        $iName = uniqid('pi_').'.jpeg';
        
        $url = file_put_contents('/home/shahinaglobal/control.shahina-global.com/storage/app/public/images/'.$iName,$image);
        
        
        $row->image = $iName;
        $row->save();
        return Response::make()->setMessage(__('admin.token update successfully'))->setResult(true)->send();


    }
    
    
    public function anyUpdateProfile(Checker $d) {
        $row = @Model::find(request()->id);
        //print_r($row);return;
        if (!$row)
            return Response::make()->setMessage(__('admin.user not found'))->send();

        if (request()->get('old_password')) {
            if (Hash::check(request()->get('old_password'), $row->password)) {
                $row->password = Hash::make(request()->password);
            } else {
                return Response::make()->setMessage(__('admin.wrong old password'))->send();
            }
        }
        $row->email = request()->email;
        $row->phone = request()->phone;
        $row->f_name = request()->f_name;
        
        $row->save();
        return Response::make()->setResult(TRUE)->setMessage(__('admin.profile updated successfully'))->send();
    }

    public function anyResetPassword(Checker $d) {
        $row = @Model::find(request()->id);
        if (!$row) {
            return Response::make()->setMessage(__('admin.user not found'))->send();
        }

        if (Hash::check(request()->get('password'), $row->password)) {
            $row->password = Hash::make(request()->new_password);
            $row->save();
            return Response::make()->setResult(TRUE)->setMessage(__('admin.password reset successfully'))->send();
        } else {
            return Response::make()->setMessage(__('admin.password not correct'))->send();
        }
    }

    public function anyViewProfile(Checker $d) {
        $row = @Model::find(request()->id);
        if (!$row) {
            return Response::make()->setMessage(__('admin.user not found'))->send();
        }
        if (request()->get('id')) {
            return Response::make()->setData($row)->setResult(TRUE)->setMessage(__('admin.user  found'))->send();
        } else {
            return Response::make()->setMessage(__('admin.profile not found'))->send();
        }
    }
    
    public function anyTest() {
        return response()->json('test');
    }

}
