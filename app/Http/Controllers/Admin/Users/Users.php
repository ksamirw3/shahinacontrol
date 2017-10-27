<?php

namespace App\Http\Controllers\Admin\Users;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Groupes
 *
 * @author jooaziz
 */
use Amit\Support\Str;
use App\Models\User as Model;
use App\Http\Validations\Admin\DreiversValidatio as check;
use App\Http\Mails\Admin\Driver as MailSender;
use App\Models\Order as DriverOrders;
use App\Models\Review;
use App\Models\Transaction;


class Users extends \App\Http\Controllers\Admin\Base {

    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
        parent::__construct();
    }

    public function getIndex() 
    {
        $userClass = new Model;

        if(request()->email)
            $userClass = $userClass->where('email','like',request()->email.'%');
        
        if(request()->username)
            $userClass = $userClass->where('username','like',request()->username.'%');

        if(request()->phone)
            $userClass = $userClass->where('phone','like',request()->phone.'%');

        return parent::view(['rows' => $userClass->paginate()]);
    }
    
    public function getChangePassword() {
        return parent::view();
    }

    public function postChangePassword(check $request,$id) {
        $row = Model::findOrFail($id);
        $row->password =\Hash::make( $request->password);
        $row->save();
      //  MailSender::newPass($row);
        return parent::redirectToIndex();
    }

    public function getArchive($id, $st) {
        Model::whereId($id)->update(['archived' => ($st == 1) ? $st : 0]);
        return back();
    }

    public function getView($id) {
        $row = $this->model->findOrFail($id);
//        dd($row);
        return parent::view(compact('row'));
    }

    public function getCreate() {

        return parent::view([ 'row' => $this->model]);
    }

    public function postCreate(check $request) {


        $row = Model::quickSave(initData::create($request));


        flash()->success(__('admin.' . Str::singular($this->module) . ' has been added Successfully'));
        return parent::redirectToIndex();
    }

    // public function getDelete($id) {
    //     Model::destroy($id);

    //     flash()->success(__('admin.' . Str::singular($this->module) . ' has been deleted Successfully'));
    //     return parent::redirectToIndex();
    // }

    public function getOrder($id) 
    {
        $rows = DriverOrders::whereDriverId($id)->paginate();
        return parent::view(compact('rows'));
    }

    public function getReviews($id) 
    {
        $rows = Review::whereUserId($id)->paginate();
        return parent::view(compact('rows'));
    }

    public function getTransactions($id) 
    {
        $rows = Transaction::whereClientId($id)->paginate();
        return parent::view(compact('rows'));
    }
}
