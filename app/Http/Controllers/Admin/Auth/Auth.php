<?php

namespace App\Http\Controllers\Admin\Auth;

use Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Authantications\AdminAuth as AA;
use \App\Http\Validations\Admin\AuthValidator as check;

class Auth extends Controller {

    public $model;

    public function __construct(\App\Models\Admin $model) {
        parent::__construct();
        AA::authanticationNotRequired(['getLogout']);
        $this->model = $model;
    }

    public function getIndex() {
        return redirect()->to('admin/auth/login');
        $admin = new \App\Models\Admin();
        $admin->username = 'super_admin';
        $admin->email = 'admin@admin.admin';
        $admin->password = \Hash::make('123456789');
        $admin->save();
    }

    public function getLogin() {
        return parent::view(['row' => $this->model]);
    }

    public function postLogin(check $request) {
        
        
        $user = $this->model->where('email', $request->get('email'))->first();
        
        $res = AuthLogic::isValid($request, $user);
        //  dd($res);
        if ($res->status) {
            AA::update_user($user);

            return redirect(AA::scope() . '/dashboard');
        }
        flash()->error($res->message);
        return redirect()->back()->withInput();
    }

    public function getForgotPassword() {
        return parent::view([ 'row' => $this->model]);
    }

    public function postForgotPassword(check $request) {
        //*** get user document contain email ***//
        $row = $this->model->where('email', $request->get('email'))->first();
//        dd($row);
        if (!$row) {
            flash()->error(__('admin.account is not exist'));
            return back()->withInput();
        }
        $new_password = str_random(8);
        if (\App\Http\Mails\Admin\Auth::forgetPassword($row, $new_password)) {
            /////////////////////////// update password
            $row->password = Hash::make($new_password);
            $row->save();
            ///////////////////////////
            flash()->success(__('admin.New password has been sent to your email'));
            return back();
        }
        flash()->error(__('admin.error had occcure please try again later'));
        return parent::redirectToIndex();
    }

    public function getLogout() {
        AA::logout();
        return redirect(AA::scope() . '/auth/login');
    }
}