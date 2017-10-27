<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Models\Rule as UG;
use Illuminate\Http\Request;
use \App\Models\Admin as Model;
use App\Http\Authantications\AdminAuth;
use App\Http\Validations\Admin\AdminValidator as check;
use Hash;

class Admins extends \App\Http\Controllers\Admin\Base {

    protected $model;

    public function __construct(Model $model) {
        parent::__construct();
        $this->model = $model;
    }

    public function getIndex() {
        $rows = $this->model->whereNotIn('id', [1, AdminAuth::id()])->paginate();
        return parent::view(compact('rows'));
    }

    public function getView($id) {
        $row = $this->model->findOrFail($id);
        return parent::view(compact('row'));
    }

    public function getCreate() {
        return parent::view(['row' => $this->model, 'rules' => UG::lists('name', 'id')]);
    }

    public function postCreate(check $request) {

        $data = initData::create($request);
        Model::quickSave($data);
        \App\Http\Mails\Admin\AdminMailer::createAdminConfirmation($data, $request);
        flash()->success(__('admin.Admin has been added Successfully'));
        return parent::redirectToIndex();
    }

    public function getEdit($id) {
        return parent::view(['row' => $this->model->findOrFail($id), 'rules' => UG::lists('name', 'id')]);
    }

    public function postEdit(check $request) {
        if (\App\Models\Branche::whereManagerId($request->id)->count() >= 1&&$request->rule_id!=Model::find($request->id)->rule_id) {
            flash()->error(__('admin.Sorry this admin is assaien to branch'));
            return back()->withInput();
        }
        Model::quickUpdate($request->except('_token'));
        flash()->success(__('admin.Admin has been edited Successfully'));
        return parent::redirectToIndex();
    }

    public function getDelete($id) {
        Model::quickDelete($id);
        flash()->success(__('admin.Admin has been deleted Successfully'));
        return parent::redirectToIndex();
    }

    public function getChangePassword() {
        return parent::view(['row' => AdminAuth::user()]);
    }

    public function postChangePassword(check $request) {
        $row = $this->model->findOrFail(AdminAuth::user()->id);
        $result = AdminModifires::validatChangPassword($request, $row);
        flash()->{$result->status}($result->message);
        return back()->withInput();
    }

    public function getEditAccount() {
        return parent::view(['row' => $this->model->findOrFail(AdminAuth::user()->id),
            'rules' => UG::lists('name', 'id')]);
    }

    public function postEditAccount(check $request) 
    {
        $data = $request->except(['_token']);
        unset($data['password_confirmation']);
        if($request->password != $request->password_confirmation)
        {
            flash()->error('paswwrods not matched');
            return back();
        }
        
        $data['password'] = Hash::make($request->password);
        $row = Model::quickUpdate($data);
        $result = AdminModifires::validateUpdateAdmin($row);
        flash()->{$result->status}($result->message);
        return redirect()->back()->withInput();
    }

    public function postActive($id, Request $request) {
//        dd($id, $request->all());
        $row = $this->model->findOrFail($id);
        $row->active = $request->get('active');
        $row->save();
        if ($request->get('active')) {
            flash()->success('admin has been actived');
        } else {

            flash()->success('admin has been deactived');
        }
        return parent::redirectToIndex();
    }

}
